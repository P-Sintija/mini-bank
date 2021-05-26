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

    public function sendTwoFactorCode(int $id): void
    {
        $user = BasicAccount::find($id);
        $twoFactorCode = $this->twoFactorAuthService->generateTwoFactorCode($user);
        $user->notify(new AuthenticationNotification($twoFactorCode, $user->id));
    }

    public function authenticated(Request $request, int $id): bool
    {
        $user = BasicAccount::find($id);
        $twoFactorCode = DB::table('user_authentication')
            ->where('id', $user->id)
            ->first();
        $this->twoFactorAuthService->deleteTwoFactorCode($user);
        return $request['twoFactorCode'] == $twoFactorCode->two_factor_code &&
            $twoFactorCode->two_factor_expires_at >= now();
    }

    public function refreshCode(int $id): void
    {
        $user = BasicAccount::find($id);
        $this->twoFactorAuthService->deleteTwoFactorCode($user);
        $this->sendTwoFactorCode($id);
    }

}
