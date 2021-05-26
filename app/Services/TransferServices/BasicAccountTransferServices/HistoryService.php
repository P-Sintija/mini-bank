<?php

namespace App\Services\TransferServices\BasicAccountTransferServices;

use App\Models\BasicAccount;
use App\Models\TransferHistory;
use App\Requests\HistoryRequest;

class HistoryService
{
    const OUTGOING = 'outgoing';
    const INCOMING = 'incoming';

    public function saveHistory(HistoryRequest $debit, HistoryRequest $credit): void
    {
        $historyData = [
            'debit_id' => $debit->getAccountData()->id,
            'debit_User_ID' => $debit->getAccountData()->User_ID,
            'debit_account_number' => $debit->getAccountData()->account_number,
            'debit_amount' => $debit->getAmount(),
            'credit_id' => $credit->getAccountData()->id,
            'credit_User_ID' => $credit->getAccountData()->User_ID,
            'credit_account_number' => $credit->getAccountData()->account_number,
            'credit_amount' => $credit->getAmount()
        ];

        $history = new TransferHistory($historyData);
        $history->save();
    }

    public function getHistory(int $id): array
    {
        $outgoing = BasicAccount::find($id)->outgoingTransfers->toArray();
        $incoming = BasicAccount::find($id)->incomingTransfers->toArray();
        $historyData = array_merge($outgoing, $incoming);
        usort($historyData, function ($transferOne, $transferTwo) {
            return $transferTwo['created_at'] <=> $transferOne['created_at'];
        });

        return $this->historyTable($historyData, $id);
    }

    private function historyTable(array $historyData, int $id): array
    {
        $history = [];
        foreach ($historyData as $data) {
            if ($data['debit_id'] == $id) {
                $other = BasicAccount::find($data['credit_id']);
                $amount = $data['debit_amount'];
                $transactionType = self::OUTGOING;
            } else {
                $other = BasicAccount::find($data['debit_id']);
                $amount = $data['credit_amount'];
                $transactionType = self::INCOMING;
            }
            $history[] = [
                'name' => $other->name,
                'surname' => $other->surname,
                'accountNumber' => $other->account_number,
                'amount' => $amount,
                'currency' => $other->currency,
                'date' => $data['created_at'],
                'transactionType' => $transactionType
            ];
        }
        return $history;
    }

}
