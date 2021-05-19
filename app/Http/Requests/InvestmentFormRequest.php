<?php

namespace App\Http\Requests;

use App\Models\BasicAccount;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentFormRequest extends FormRequest
{

//    public function authorize()
//    {
//        return false;
//    }


    public function rules()
    {
        $user = BasicAccount::find($this->route('id'));
        return [
            'amount' => ['required', 'numeric', 'min:0', "max:$user->balance"]
        ];
    }
}
