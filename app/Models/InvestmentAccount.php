<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'User_ID',
        'name',
        'surname',
        'investment_amount',
        'actual balance',
        'account_number',
        'currency'
    ];
}
