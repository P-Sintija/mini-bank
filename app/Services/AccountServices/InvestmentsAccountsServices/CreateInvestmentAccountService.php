<?php

namespace App\Services\AccountServices\InvestmentsAccountsServices;

use App\Http\Requests\InvestmentFormRequest;
use App\Models\BasicAccount;
use App\Models\InvestmentAccount;
use App\Services\AccountServices\GenerateAccountNumberService;
use App\Services\TransferServices\InvestmentAccountTransfers\InvestmentTransferService;


class CreateInvestmentAccountService
{
    private GenerateAccountNumberService $createAccountNumberService;
    private InvestmentTransferService $investmentTransferService;

    public function __construct(
        GenerateAccountNumberService $createAccountNumberService,
        InvestmentTransferService $investmentTransferService
    )
    {
        $this->createAccountNumberService = $createAccountNumberService;
        $this->investmentTransferService = $investmentTransferService;
    }

    public function accountNumber(): string
    {
        return $this->createAccountNumberService->getAccountNumber();
    }


    public function execute(InvestmentFormRequest $request, BasicAccount $user)
    {
        $accountData = [
            'basic_account_id' => $user->id,
            'User_ID' => $user->User_ID,
            'name' => $user->name,
            'surname' => $user->surname,
            'investment_amount' => 0,
            'actual_balance' => 0,
            'account_number' => $request->request->get('accountNumber'),
            'currency' => $user->currency
        ];

        $account = new InvestmentAccount($accountData);
        $account->save();

        $this->updateBasicAccount($user, $account);
        $this->transferMoney($user, $account, $request->request->get('amount'));
    }

    private function updateBasicAccount(BasicAccount $user, InvestmentAccount $account): void
    {
        $user->update([
            'investment_account_id' => $account::where('basic_account_id', $user->id)
                ->pluck('id')
                ->first()
        ]);
    }

    private function transferMoney(BasicAccount $basicAccount, InvestmentAccount $investmentAccount, int $amount): void
    {
        $this->investmentTransferService->deposit($basicAccount, $investmentAccount, $amount);
    }
}
