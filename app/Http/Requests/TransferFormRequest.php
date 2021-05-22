<?php

namespace App\Http\Requests;

use App\Models\BasicAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferFormRequest extends FormRequest
{
    public function rules(): array
    {
        $user = BasicAccount::find($this->route('id'));
        $creditAccount = BasicAccount::where('account_number', $this->account_number)->first();

        if ($creditAccount === null) {
            return [
                'account_number' => ['required', 'exists:App\Models\BasicAccount,account_number']
            ];
        }
        return [
            'name' => ['required', Rule::in([$creditAccount->name])],
            'surname' => ['required', Rule::in([$creditAccount->surname])],
            'account_number' => ['required', Rule::in([$creditAccount->account_number]),
                Rule::notIn([$user->account_number])],
            'amount' => ['required', 'numeric', 'min:0', "max:$user->balance"]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->request->set('amount', str_replace(',', '.', $this->amount));

        if (is_numeric($this->request->get('amount'))) {
            $this->request->set('amount', $this->amount * 100);
        }
    }
}
