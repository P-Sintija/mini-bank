<?php

namespace App\Services\NewCostumerServices;


use App\Models\BasicAccount;
use App\Models\Currency;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateBasicAccService
{
    private GenerateUserIDService $createUserIDService;
    private GenerateAccountNumberService $createAccountNumberService;

    public function __construct(
        GenerateUserIDService $createUserIDService,
        GenerateAccountNumberService $createAccountNumberService
    )
    {
        $this->createUserIDService = $createUserIDService;
        $this->createAccountNumberService = $createAccountNumberService;
    }

    public function stored(Request $request): bool
    {
        if ($this->emailVerification($request)) {
            $UserID = $this->createUserIDService->getUserID();
            $AccountNumber = $this->createAccountNumberService->getAccountNumber();
            $this->store($request, $UserID, $AccountNumber);
            EmailVerification::where('email', $request['email'])->delete();
            return true;
        }
        EmailVerification::where('email', $request['email'])->delete();
        return false;
    }

    private function emailVerification(Request $request): bool
    {
        $data = EmailVerification::where('email', $request['email'])->first();
        return strtotime($data['expires_at']) >= time();
    }

    private function store(Request $request, string $UserID, string $AccountNumber): void
    {
        $data = EmailVerification::where('email', $request['email'])->first();
        $accountData = [
            'name' => $data->name,
            'surname' => $data->surname,
            'SSN' => $data->SSN,
            'email' => $data->email,
            'hash' => Hash::make($data->password),
            'balance' => $data->balance * 100,
            'User_ID' => $UserID,
            'account_number' => $AccountNumber,
            'currency' => Currency::where('id', $data->currency)->first()['symbol']
        ];

        $account = new BasicAccount($accountData);
        $account->save();
    }


}
