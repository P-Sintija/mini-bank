<?php

namespace App\Services\AuthenticationServices;

use App\Models\BasicAccount;
use Illuminate\Support\Facades\Hash;

class PasswordCheckService
{
    public function validate(BasicAccount $user, string $password): bool
    {
        return Hash::check($password, $user->hash);
       // return password_verify($password, $user->hash);
    }
}
