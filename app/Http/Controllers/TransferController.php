<?php

namespace App\Http\Controllers;

use App\Helpers\TransferRequest;
use App\Models\BasicAccount;
use App\Services\AuthenticationServices\AuthenticationService;
use App\Services\TransferServices\TransferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class TransferController
{
    private AuthenticationService $authenticationService;
    private TransferService $transferService;

    public function __construct(
        AuthenticationService $authenticationService,
        TransferService $transferService
    )
    {
        $this->authenticationService = $authenticationService;
        $this->transferService = $transferService;
    }

    public function sendCode(int $id): RedirectResponse
    {
        $user = BasicAccount::find($id);
        $this->authenticationService->sendTwoFactorCode($user, 'authenticateTransaction.verification');
        return redirect()->route('authenticationForm.show', ['id' => $user->id]);
    }


    public function execute(int $id): RedirectResponse
    {
        // $transferData = $transaction = session()->pull('_transaction');

        $transferData = $transaction = session()->get('_transaction');

        $transfer = new TransferRequest(
            BasicAccount::where('id', $transferData['user_id'])->first(),
            $transferData['debit'],
            BasicAccount::where('id', $transferData['recipient_id'])->first(),
            $transferData['credit']
        );

        $this->transferService->execute($transfer);
        return redirect()->route('basicAccount.show', ['id' => $id])->
        withMessage('Transfer completed!');
    }
}
