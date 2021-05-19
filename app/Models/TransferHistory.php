<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'debit_id',
        'debit_User_ID',
        'debit_account_number',
        'debit_amount',
        'credit_id',
        'credit_User_ID',
        'credit_account_number',
        'credit_amount'
    ];

}
