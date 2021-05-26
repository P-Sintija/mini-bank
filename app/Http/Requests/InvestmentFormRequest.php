<?php

namespace App\Http\Requests;

use App\Models\BasicAccount;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentFormRequest extends FormRequest
{
    public function rules(): array
    {
        $user = BasicAccount::find($this->route('id'));
        return [
            'amount' => ['required', 'numeric', 'min:0', "max:$user->balance"],

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
