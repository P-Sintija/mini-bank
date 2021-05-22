<?php

namespace App\Http\Controllers;

use App\Models\BasicAccount;
use App\Services\TransferServices\HistoryService;
use Illuminate\Contracts\View\View;

class TransferHistoryController extends Controller
{
    private HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function show(int $id): View
    {
       $history = $this->historyService->getHistory($id);
       $account = BasicAccount::find($id);
        return view('transferHistory', [
            'history' => $history,
            'account' => $account
            ]);
    }
}
