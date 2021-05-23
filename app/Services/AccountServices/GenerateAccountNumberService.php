<?php

namespace App\Services\AccountServices;

use App\Models\BasicAccount;

class GenerateAccountNumberService
{
    const BANK_COUNTRY = 'LV_';
    const BANK_SYMBOL = 'MINI';
    const DIGIT_COUNT = 13;

    public function getAccountNumber(): string
    {
        while (true) {
            $accountNumber = self::BANK_COUNTRY . self::BANK_SYMBOL . $this->generateNumbers();
            if (BasicAccount::where('account_number', $accountNumber)->first() === null) {
                return $accountNumber;
            }
        }
    }

    public function generateNumbers(): string
    {
        $digitCount = 0;
        $randomNumbers = '';
        while ($digitCount < self::DIGIT_COUNT) {
            $randomNumbers = $randomNumbers . rand(0, 9);
            $digitCount++;
        }
        return $randomNumbers;
    }
}


