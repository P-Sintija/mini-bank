<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferFormRequest;
use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use App\Services\TransferServices\BasicAccountTransferServices\TransferContentService;
use Illuminate\Contracts\View\View;


class TransferContentController extends Controller
{
    private BasicAccountService $basicAccountService;
    private TransferContentService $transferService;

    public function __construct(
        BasicAccountService $basicAccountService,
        TransferContentService $transferService
    )
    {
        $this->basicAccountService = $basicAccountService;
        $this->transferService = $transferService;
    }

    public function show(int $id): View
    {
        $user = $this->basicAccountService->handle($id);
        session()->forget('_transaction');
        return view('transfers.transferForm', [
            'account' => $user
        ]);
    }

    public function inform(int $id, TransferFormRequest $request): View
    {
        $transferInfo = $this->transferService->handle($id, $request);
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
