<?php

namespace App\Services\TransferServices;

use App\Models\BasicAccount;
use App\Models\TransferHistory;

use App\Requests\HistoryRequest;
use Illuminate\Support\Facades\DB;

class HistoryService
{
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
        $historyData = DB::table('transfer_histories')
            ->where('debit_id', $id)
            ->orWhere('credit_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        return $this->historyTable($historyData, $id);
    }

    private function historyTable(array $historyData, int $id): array
    {
        $history = [];

        foreach ($historyData as $data) {
            if ($data->debit_id == $id) {
                $user = BasicAccount::where('id', $data->debit_id)->first();
                $recipient = BasicAccount::where('id', $data->credit_id)->first();
                $history[] = [
                    'name' => $recipient->name,
                    'surname' => $recipient->surname,
                    'accountNumber' => $recipient->account_number,
                    'amount' => $data->debit_amount,
                    'currency' => $user->currency,
                    'date' => $data->created_at,
                    'transactionType' => 'outgoing'
                ];
            } else {
                $user = BasicAccount::where('id', $data->credit_id)->first();
                $provider = BasicAccount::where('id', $data->debit_id)->first();
                $history[] = [
                    'name' => $provider->name,
                    'surname' => $provider->surname,
                    'accountNumber' => $provider->account_number,
                    'amount' => $data->credit_amount,
                    'currency' => $user->currency,
                    'date' => $data->created_at,
                    'transactionType' => 'incoming'
                ];
            }
        }
        return $history;
    }

}
