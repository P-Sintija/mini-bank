<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'symbol' => 'required',
            'number' => ['required', 'numeric', 'min:1']
        ];
    }
}
