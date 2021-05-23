<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockFormRequest;
use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Requests\StockRequest;
use App\Services\StockServices\StockMarketService;
use App\Services\TransferServices\TransactionServices\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockMarketService $stockMarketService;
    private TransactionService $transactionService;

    public function __construct(StockMarketService $stockMarketService,
                                TransactionService $transactionService)
    {
        $this->stockMarketService = $stockMarketService;
        $this->transactionService = $transactionService;
    }

    public function index(StockFormRequest $request): RedirectResponse
    {
        $stockData = $this->stockMarketService->handle($request);
        $account = InvestmentAccount::where('basic_account_id', $request['basicAccountId'])->first();
        if ($stockData != null) {
            session()->put(['_stockData' => $stockData]);
            return redirect()->route('investmentAccount.index', ['id' => $account->basic_account_id]);
        } else {
            return redirect()->route('investmentAccount.index', ['id' => $account->basic_account_id])
                ->withErrors('Invalid stock symbol input');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $stockData = session()->pull('_stockData');
        //$stockData = session()->get('_stockData');
        $stock = new StockRequest(
            $stockData->costs(),
            $stockData->numberOf(),
            $stockData->symbol()
        );

        $investmentAccount = InvestmentAccount::where('basic_account_id', $request['basicAccountId'])->first();
        if ($this->transactionService->purchase($stock, $investmentAccount)) {
            return redirect()->route('investmentAccount.index', ['id' => $investmentAccount->basic_account_id]);
        }
        return redirect()->route('investmentAccount.index', ['id' => $investmentAccount->basic_account_id])
            ->withErrors('Sorry! You do not have enough money in your account!');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $investmentAccount = InvestmentAccount::find($request['investmentAccountId']);
        $stock = Stock::find($id);
        $this->transactionService->sale($stock, $investmentAccount);
        return redirect()->route('investmentAccount.index', ['id' => $investmentAccount->basic_account_id])
            ->withMessage('Stocks were sold!');
    }

}
