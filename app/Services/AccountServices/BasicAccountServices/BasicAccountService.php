<?php

namespace App\Services\AccountServices\BasicAccountServices;

use App\Http\Requests\LogInRequest;
use App\Models\BasicAccount;

class BasicAccountService
{
    public function handle(int $id): BasicAccount
    {
        return BasicAccount::find($id);
    }

    public function getByUserId(LogInRequest $request): BasicAccount
    {
        return BasicAccount::where('User_ID', $request['userId'])->first();
    }
}
