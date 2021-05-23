<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferFormRequest;
use App\Models\BasicAccount;
use App\Services\TransferServices\BasicAccountTransferServices\TransferContentService;
use Illuminate\Contracts\View\View;


class TransferContentController extends Controller
{
    private TransferContentService $transferService;

    public function __construct(
        TransferContentService $transferService
    )
    {
        $this->transferService = $transferService;
    }

    public function show(int $id): View
    {
        $accountData = BasicAccount::where('id', $id)->first();
        session()->forget('_transaction');
        return view('transfers.transferForm', [
            'account' => $accountData
        ]);
    }

    public function inform(int $id, TransferFormRequest $request): View
    {
        $debitAccount = BasicAccount::where('id', $id)->first();
        $transferInfo =  $transaction = $this->transferService->handle($debitAccount, $request);

        session()->put([
            '_transaction' => [
                'user_id' => $transferInfo->debitAccount()->id,
                'recipient_id' => $transferInfo->creditAccount()->id,
                'debit' => $transferInfo->debit(),
                'credit' => $transferInfo->credit()
            ]
        ]);

        return view('transfers.transferInformation', [
            'userAccount' => $transferInfo->debitAccount(),
            'recipientsAccount' => $transferInfo->creditAccount(),
            'amount' => number_format($transferInfo->debit() / 100, 2),
            'total' => number_format($transferInfo->credit() / 100, 2)
        ]);
    }

}
