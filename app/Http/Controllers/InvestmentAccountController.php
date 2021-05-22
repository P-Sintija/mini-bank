<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Http\Requests\InvestmentWithdrawalRequest;
use App\Models\BasicAccount;
use App\Models\InvestmentAccount;
use App\Services\TransferServices\InvestmentAccountTransfers\InvestmentTransferService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class InvestmentAccountController extends Controller
{
    private InvestmentTransferService $investmentTransferService;

    public function __construct(
        InvestmentTransferService $investmentTransferService
    )
    {
        $this->investmentTransferService = $investmentTransferService;
    }

    public function index(int $id): View
    {
        $account = InvestmentAccount::where('basic_account_id', $id)->first();
        return view('investmentAccount', [
            'account' => $account
        ]);
    }

    public function deposit(int $id, InvestmentFormRequest $request): RedirectResponse
    {
        $basicAccount = BasicAccount::find($id);
        $investmentAccount = InvestmentAccount::find($request->all()['investmentAccountId']);
        $amount = $request->all()['amount'];
        $this->investmentTransferService->deposit($basicAccount, $investmentAccount, $amount);
        return redirect()->route('investmentAccount.index', ['id' => $id]);
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
