<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogInRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'userId' => ['required', 'exists:App\Models\BasicAccount,User_ID'],
            'password' => ['required']
        ];
    }
}
