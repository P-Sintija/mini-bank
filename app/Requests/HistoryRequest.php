<?php

namespace App\Requests;

use App\Models\BasicAccount;

class HistoryRequest
{
    private BasicAccount $accountData;
    private int $amount;

    public function __construct(BasicAccount $accountData, int $amount)
    {
        $this->accountData = $accountData;
        $this->amount = $amount;
    }

    public function getAccountData(): BasicAccount
    {
        return $this->accountData;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
