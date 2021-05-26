<?php

namespace App\Services\TransferServices\InvestmentAccountTransfers;


use App\Http\Requests\InvestmentWithdrawalRequest;
use App\Models\BasicAccount;


class InvestmentTransferService
{
    const DUTY = 0.20;

    public function deposit(int $id, int $amount): void
    {
        $basicAccount = BasicAccount::find($id);
        $investmentAccount = $basicAccount->investmentAccount;

        $basicAccount->removeBalance($amount);
        $investmentAccount->addBalance($amount);
    }

    public function withdrawal(int $id, InvestmentWithdrawalRequest $request): void
    {
        $basicAccount = BasicAccount::find($id);
        $investmentAccount = $basicAccount->investmentAccount;
        $amount = $request['amount'];

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
