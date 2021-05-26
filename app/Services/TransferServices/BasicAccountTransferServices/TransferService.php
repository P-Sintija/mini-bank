<?php

namespace App\Services\TransferServices\BasicAccountTransferServices;


use App\Requests\HistoryRequest;
use App\Requests\TransferRequest;

class TransferService
{
    private HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function execute(TransferRequest $transfer): void
    {
        $transfer->debitAccount()->removeBalance($transfer->debit());
        $transfer->creditAccount()->addBalance($transfer->credit());

        $this->historyService->saveHistory(
            new HistoryRequest($transfer->debitAccount(), $transfer->debit()),
            new HistoryRequest($transfer->creditAccount(), $transfer->credit())
        );
    }

}
