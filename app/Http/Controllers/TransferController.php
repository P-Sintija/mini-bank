<?php

namespace App\Http\Controllers;


use App\Models\BasicAccount;
use App\Requests\TransferRequest;
use App\Services\AuthenticationServices\AuthenticationService;
use App\Services\TransferServices\BasicAccountTransferServices\TransferService;
use Illuminate\Http\RedirectResponse;



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

    public function store(int $id): RedirectResponse
    {
        $this->authenticationService->sendTwoFactorCode($id);
        return redirect()->route('authenticationForm.show', ['id' => $id]);
    }


    public function execute(int $id): RedirectResponse
    {
         $transferData = session()->pull('_transaction');
       // $transferData = session()->get('_transaction');

        $transfer = new TransferRequest(
            BasicAccount::where('id', $transferData['user_id'])->first(),
            $transferData['debit'],
            BasicAccount::where('id', $transferData['recipient_id'])->first(),
            $transferData['credit']
        );

        $this->transferService->execute($transfer);
        return redirect()->route('basicAccount.index', ['id' => $id])
            ->withMessage('Transfer completed!');
    }
}
