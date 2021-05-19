<?php

namespace App\Services\InvestmentAccountsServices;

use App\Http\Requests\InvestmentFormRequest;
use App\Models\BasicAccount;
use App\Models\InvestmentAccount;

class CreateInvestmentAccountService
{
    public function saveAccount(InvestmentFormRequest $request, BasicAccount $user)
    {
        $accountData = [
            'id' => $user->id,
            'User_ID' => $user->User_ID,
            'name' => $user->name,
            'surname' => $user->surname,
            'investment_amount' => $request['amount'],
            'actual balance' => $request['amount'],
            'account_number' => $request['accountNumber'],
            'currency' => $user->currency
        ];

        $account = new InvestmentAccount($accountData);
        $account->save();
    }
}
