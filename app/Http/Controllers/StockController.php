<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockFormRequest;
use App\Models\InvestmentAccount;
use App\Requests\StockRequest;
use App\Services\StockServices\StockService;
use App\Services\TransferServices\TransactionServices\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockService $stockService;
    private TransactionService $transactionService;

    public function __construct(
        StockService $stockService,
        TransactionService $transactionService
    )
    {
        $this->stockService = $stockService;
        $this->transactionService = $transactionService;
    }

    public function index(StockFormRequest $request): RedirectResponse
    {
        $stockData = $this->stockService->stockData($request);
        if ($stockData != null) {
            session()->put(['_stockData' => $stockData]);
            return redirect()->route('investmentAccount.index', ['id' => $request['basicAccountId']]);
        } else {
            return redirect()->route('investmentAccount.index', ['id' => $request['basicAccountId']])
                ->withErrors('Invalid stock symbol input');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $stockData = session()->pull('_stockData');
        $stock = new StockRequest(
            $stockData->costs(),
            $stockData->numberOf(),
            $stockData->symbol()
        );

        if ($this->transactionService->purchase($stock, $request['basicAccountId'])) {
            return redirect()->route('investmentAccount.index', ['id' => $request['basicAccountId']]);
        }
        return redirect()->route('investmentAccount.index', ['id' => $request['basicAccountId']])
            ->withErrors('Sorry! You do not have enough money in your account!');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->transactionService->sale($id, $request);
        return redirect()->route('investmentAccount.index', ['id' => $id])
            ->withMessage('Stocks were sold!');
    }

}
