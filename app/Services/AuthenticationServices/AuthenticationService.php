<?php

namespace App\Services\AuthenticationServices;

use App\Models\BasicAccount;
use App\Notifications\AuthenticationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthenticationService
{
    private TwoFactorAuthService $twoFactorAuthService;

    public function __construct(TwoFactorAuthService $twoFactorAuthService)
    {
        $this->twoFactorAuthService = $twoFactorAuthService;
    }

    public function sendTwoFactorCode(BasicAccount $user): void
    {
        $twoFactorCode = $this->twoFactorAuthService->generateTwoFactorCode($user);
        $user->notify(new AuthenticationNotification($twoFactorCode, $user->id));
    }

    public function authenticated(Request $request, BasicAccount $user): bool
    {
        $twoFactorCode = DB::table('user_authentication')
            ->where('id', $user->id)
            ->first();
        $this->twoFactorAuthService->deleteTwoFactorCode($user);
        return $request['twoFactorCode'] == $twoFactorCode->two_factor_code &&
            $twoFactorCode->two_factor_expires_at >= now();
    }

    public function refreshCode(BasicAccount $user): void
    {
        $this->twoFactorAuthService->deleteTwoFactorCode($user);
        $this->sendTwoFactorCode($user);
    }

}
