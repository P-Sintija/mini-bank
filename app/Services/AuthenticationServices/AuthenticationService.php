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

    public function sendTwoFactorCode(BasicAccount $user, string $routName)
    {
        $twoFactorCode = $this->twoFactorAuthService->generateTwoFactorCode($user);
        $user->notify(new AuthenticationNotification($twoFactorCode, $user->id, $routName));
    }

    public function authenticated(Request $request, BasicAccount $user): bool
    {
        if ($this->verify($request, $user)) {
           // $this->twoFactorAuthService->deleteTwoFactorCode($user);
            return true;
        }
        return false;
    }

    public function refreshCode(BasicAccount $user): void
    {
        $this->twoFactorAuthService->deleteTwoFactorCode($user);
        $this->twoFactorAuthService->generateTwoFactorCode($user);
    }

    private function verify(Request $request, BasicAccount $user): bool
    {
        $twoFactorCode = DB::table('user_authentication')
            ->where('id', $user->id)
            ->first();
        return $request['twoFactorCode'] == $twoFactorCode->two_factor_code &&
            $twoFactorCode->two_factor_expires_at >= now();
    }
}
