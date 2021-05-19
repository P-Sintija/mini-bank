<?php

namespace App\Services\NewCostumerServices;

use App\Models\BasicAccount;

class GenerateUserIDService
{
    const DIGIT_COUNT = 6;

    public function getUserID(): string
    {
        while (true) {
            $userId = $this->userIDLetter() . $this->userIDNumber();
            if (BasicAccount::where('User_ID', $userId)->first() === null) {
                return $userId;
            }
        }
    }

    private function userIDLetter(): string
    {
        return chr(rand(65, 90));
    }

    private function userIDNumber(): string
    {
        $randomNumbers = '';
        $digitCount = 0;
        while ($digitCount < self::DIGIT_COUNT) {
            $randomNumbers = $randomNumbers . rand(0, 9);
            $digitCount++;
        }
        return $randomNumbers;
    }
}
