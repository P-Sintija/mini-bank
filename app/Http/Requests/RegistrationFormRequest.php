<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha', 'min:3', 'max:50'],
            'surname' => ['required', 'alpha', 'min:3', 'max:50'],
            'SSN' => ['required', 'numeric', 'digits:10', 'unique:App\Models\BasicAccount,SSN'],
            'email' => ['required', 'email', 'unique:App\Models\BasicAccount,email'],
            'balance' => ['required', 'numeric', 'gt:0'],
            'password' => 'required',
            'retypePassword' => ['required', 'same:password']
        ];
    }

    public function prepareForValidation(): void
    {
        $this->request->set('SSN', str_replace('-', '', $this->SSN));
        $this->request->set('balance', str_replace(',', '.', $this->balance));
    }


}
