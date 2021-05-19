<?php
namespace App\Services\TransferServices;

use App\Models\BasicAccount;

class AccountCreditService {

    public function add(BasicAccount $creditAccount, int $amount): void
    {
        //todo - notification
        $creditAccount->addBalance($amount);
    }




}


