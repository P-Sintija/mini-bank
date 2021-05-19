<?php
namespace App\Services\TransferServices;

use App\Helpers\HistoryRequest;
use App\Helpers\TransferRequest;
use App\Models\BasicAccount;

class TransferService
{
    private AccountDebitService $accountDebitService;
    private AccountCreditService $accountCreditService;
    private HistoryService $historyService;

    public function __construct(
        AccountDebitService $accountDebitService,
        AccountCreditService $accountCreditService,
        HistoryService $historyService
    )
    {
        $this->accountDebitService = $accountDebitService;
        $this->accountCreditService = $accountCreditService;
        $this->historyService = $historyService;
    }

    public function execute(TransferRequest $transfer): void
    {
        $this->accountDebitService->remove($transfer->debitAccount(), $transfer->debit());
        $this->accountCreditService->add($transfer->creditAccount(), $transfer->credit());

        $this->historyService->saveHistory(
            new HistoryRequest($transfer->debitAccount(), $transfer->debit()),
            new HistoryRequest($transfer->creditAccount(), $transfer->credit())
        );
    }

}