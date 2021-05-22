<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'basic_account_id',
        'User_ID',
        'name',
        'surname',
        'investment_amount',
        'actual_balance',
        'account_number',
        'currency'
    ];

    public function addBalance(int $amount): void
    {
        $this->investment_amount = $this->investment_amount + $amount;
        $this->actual_balance = $this->actual_balance + $amount;
        $this->save();
    }

    public function removeBalance(int $amount): void
    {
        $this->actual_balance = $this->actual_balance - $amount;
        $this->investment_amount = $this->investment_amount - $amount;
        if ($this->investment_amount < 0) {
            $this->investment_amount = 0;
        }
        $this->save();
    }
}
