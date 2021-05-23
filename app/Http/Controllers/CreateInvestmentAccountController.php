<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Models\BasicAccount;

use App\Services\AccountServices\InvestmentsAccountsServices\CreateInvestmentAccountService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CreateInvestmentAccountController extends Controller
{
    private CreateInvestmentAccountService $investmentAccountService;

    public function __construct(CreateInvestmentAccountService $investmentAccountService)
    {
        $this->investmentAccountService = $investmentAccountService;
    }

    public function show(int $id): View
    {
        $user = BasicAccount::find($id);
        $accountNumber = $this->investmentAccountService->accountNumber();
        return view('investment-account.investmentAccountForm', [
            'account' => $user,
            'investmentAccountNumber' => $accountNumber
        ]);
    }

    public function store(int $id, InvestmentFormRequest $request): RedirectResponse
    {
        $user = BasicAccount::find($id);
        $this->investmentAccountService->execute($request, $user);
        return redirect()->route('investmentAccount.index',['id' => $user->id]);
    }

}
