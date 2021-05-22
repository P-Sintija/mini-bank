<?php

namespace App\Services\TransferServices\InvestmentAccountTransfers;

use App\Models\BasicAccount;
use App\Models\InvestmentAccount;

class InvestmentTransferService
{
    const DUTY = 0.20;

    public function deposit(BasicAccount $basicAccount, InvestmentAccount $investmentAccount, int $amount): void
    {
        $basicAccount->removeBalance($amount);
        $investmentAccount->addBalance($amount);
    }

    public function withdrawal(BasicAccount $basicAccount, InvestmentAccount $investmentAccount, int $amount): void
    {
        if ($amount > $investmentAccount->investment_amount) {
            $difference = $amount - $investmentAccount->investment_amount;
            $duty = $difference * self::DUTY;
            $total = $investmentAccount->investment_amount + $difference - $duty;
            $basicAccount->addBalance($total);
            $investmentAccount->removeBalance($amount);
        } else {
            $basicAccount->addBalance($amount);
            $investmentAccount->removeBalance($amount);
        }
    }

}
