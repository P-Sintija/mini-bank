<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Http\Requests\InvestmentWithdrawalRequest;
use App\Models\BasicAccount;
use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use App\Services\StockServices\StockService;
use App\Services\TransferServices\InvestmentAccountTransfers\InvestmentTransferService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class InvestmentAccountController extends Controller
{
    private BasicAccountService $basicAccountService;
    private InvestmentTransferService $investmentTransferService;
    private StockService $stockService;

    public function __construct(
        BasicAccountService $basicAccountService,
        InvestmentTransferService $investmentTransferService,
        StockService $stockService
    )
    {
        $this->basicAccountService = $basicAccountService;
        $this->investmentTransferService = $investmentTransferService;
        $this->stockService = $stockService;
    }

    public function index(int $id): View
    {
        $account = $this->basicAccountService->handle($id)->investmentAccount;
        $stocks = $account->stocks;
        $currentPrices = $this->stockService->handle($stocks);

        return view('investment-account.investmentAccount', [
            'account' => $account,
            'stocks' => $stocks,
            'currentPrices' => $currentPrices
        ]);
    }

    public function deposit(int $id, InvestmentFormRequest $request): RedirectResponse
    {
        $this->investmentTransferService->deposit($id, $request['amount']);
        return redirect()->route('investmentAccount.index', ['id' => $id])
            ->withMessage('Deposit was successful!');
    }

    public function withdrawal(int $id, InvestmentWithdrawalRequest $request): RedirectResponse
    {
        $this->investmentTransferService->withdrawal($id, $request);
        return redirect()->route('investmentAccount.index', ['id' => $id])
            ->withMessage('Withdrawal was successful!');
    }

}
