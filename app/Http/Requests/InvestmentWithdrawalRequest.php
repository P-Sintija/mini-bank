<?php

namespace App\Http\Requests;

use App\Models\InvestmentAccount;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentWithdrawalRequest extends FormRequest
{

    public function rules(): array
    {
        $investmentAccount = InvestmentAccount::where('basic_account_id', $this->route('id'))
            ->first();

        return [
            'amount' => ['required', 'numeric', 'min:0', "max:$investmentAccount->actual_balance"],
            $this->route('id') => ['unique:App\Models\InvestmentAccount,basic_account_id']

        ];
    }

    public function prepareForValidation(): void
    {
        $this->request->set('amount', str_replace(',', '.', $this->amount) * 100);
    }
}
