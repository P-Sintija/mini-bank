<?php

namespace App\Services\AuthenticationServices;

use App\Models\BasicAccount;
use Illuminate\Support\Facades\DB;

class TwoFactorAuthService
{
    const TIME_LIMIT = 10;

    public function generateTwoFactorCode(BasicAccount $user): int
    {
        $twoFactorCode = rand(10000, 99999);
        DB::table('user_authentication')
            ->insert([
                'id' => $user->id,
                'two_factor_code' => $twoFactorCode,
                'two_factor_expires_at' => now()->addMinutes(self::TIME_LIMIT)
            ]);
        return $twoFactorCode;
    }

    public function deleteTwoFactorCode(BasicAccount $user): void
    {
        DB::table('user_authentication')
            ->where('id', $user->id)
            ->delete();
    }
}
