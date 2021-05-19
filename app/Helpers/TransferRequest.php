<?php

namespace App\Helpers;

use App\Models\BasicAccount;

class TransferRequest
{
    private BasicAccount $debitAccount;
    private int $debit;
    private BasicAccount $creditAccount;
    private int $credit;

    public function __construct(BasicAccount $debitAccount, int $debit, BasicAccount $creditAccount, int $credit)
    {
        $this->debitAccount = $debitAccount;
        $this->debit = $debit;
        $this->creditAccount = $creditAccount;
        $this->credit = $credit;
    }

    public function debitAccount(): BasicAccount
    {
        return $this->debitAccount;
    }

    public function debit(): int
    {
        return $this->debit;
    }

    public function creditAccount(): BasicAccount
    {
        return $this->creditAccount;
    }

    public function credit(): int
    {
        return $this->credit;
    }
}
