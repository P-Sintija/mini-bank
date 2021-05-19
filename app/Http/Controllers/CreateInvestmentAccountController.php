<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Models\BasicAccount;
use App\Services\InvestmentAccountsServices\CreateInvestmentAccountService;
use App\Services\NewCostumerServices\GenerateAccountNumberService;


class CreateInvestmentAccountController extends Controller
{
    private GenerateAccountNumberService $generateAccountNumberService;
    private CreateInvestmentAccountService $investmentAccountService;

    public function __construct(
        GenerateAccountNumberService $generateAccountNumberService,
        CreateInvestmentAccountService $investmentAccountService
    )
    {
        $this->generateAccountNumberService = $generateAccountNumberService;
        $this->investmentAccountService = $investmentAccountService;
    }

    public function accountsForm(int $id)
    {
        $user = BasicAccount::find($id);
        $accountNumber = $this->generateAccountNumberService->getAccountNumber();
        return view('investmentAccountForm', [
            'account' => $user,
            'investmentAccountNumber' => $accountNumber
        ]);
    }

    public function createAccount(int $id, InvestmentFormRequest $request)
    {
        $request['amount'] = str_replace(',', '.', $request['amount']) * 100;
        $request->validated();
        $user = BasicAccount::find($id);
        $this->investmentAccountService->saveAccount($request, $user);
    }

}
