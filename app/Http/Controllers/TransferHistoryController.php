<?php

namespace App\Http\Controllers;


use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use App\Services\TransferServices\BasicAccountTransferServices\HistoryService;
use Illuminate\Contracts\View\View;

class TransferHistoryController extends Controller
{
    private BasicAccountService $basicAccountService;
    private HistoryService $historyService;

    public function __construct(
        BasicAccountService $basicAccountService,
        HistoryService $historyService)
    {
        $this->basicAccountService = $basicAccountService;
        $this->historyService = $historyService;
    }

    public function show(int $id): View
    {
        $history = $this->historyService->getHistory($id);
        $account = $this->basicAccountService->handle($id);
        return view('transfers.transferHistory', [
            'history' => $history,
            'account' => $account
        ]);
    }
}
