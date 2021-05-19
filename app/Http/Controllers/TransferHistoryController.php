<?php

namespace App\Http\Controllers;

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
        return view('transferHistory', [
            'history' => $history,
            'id' => $id
            ]);
    }
}
