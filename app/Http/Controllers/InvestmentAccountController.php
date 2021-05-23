<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Http\Requests\InvestmentWithdrawalRequest;
use App\Models\BasicAccount;
use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Services\StockServices\StockService;
use App\Services\TransferServices\InvestmentAccountTransfers\InvestmentTransferService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class InvestmentAccountController extends Controller
{
    private InvestmentTransferService $investmentTransferService;
    private StockService $stockService;

    public function __construct(
        InvestmentTransferService $investmentTransferService,
        StockService $stockService
    )
    {
        $this->investmentTransferService = $investmentTransferService;
        $this->stockService = $stockService;
    }

    public function index(int $id): View
    {
        $account = InvestmentAccount::where('basic_account_id', $id)->first();
        $stocks = Stock::where('investment_account_id',$account->id)->get();
        $currentPrices = $this->stockService->handle($stocks);

        return view('investment-account.investmentAccount', [
            'account' => $account,
            'stocks' => $stocks,
            'currentPrices' => $currentPrices
        ]);
    }

    public function deposit(int $id, InvestmentFormRequest $request): RedirectResponse
    {
        $basicAccount = BasicAccount::find($id);
        $investmentAccount = InvestmentAccount::find($request->all()['investmentAccountId']);
        $amount = $request->all()['amount'];

        $this->investmentTransferService->deposit($basicAccount, $investmentAccount, $amount);
        return redirect()->route('investmentAccount.index', ['id' => $id])
            ->withMessage('Deposit was successful!');
    }

    public function withdrawal(int $id, InvestmentWithdrawalRequest $request): RedirectResponse
    {
        $basicAccount = BasicAccount::find($id);
        $investmentAccount = InvestmentAccount::find($request->all()['investmentAccountId']);
        $amount = $request->all()['amount'];

        $this->investmentTransferService->withdrawal($basicAccount, $investmentAccount, $amount);
        return redirect()->route('investmentAccount.index', ['id' => $id])
            ->withMessage('Withdrawal was successful!');
    }

}
