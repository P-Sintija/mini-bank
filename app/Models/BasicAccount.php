<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BasicAccount extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'basic_accounts';
    protected $fillable = [
        'name',
        'surname',
        'SSN',
        'email',
        'hash',
        'balance',
        'User_ID',
        'account_number',
        'currency',
        'investment_account_id'
    ];

    public function removeBalance(int $amount): void
    {
        $this->balance = $this->balance - $amount;
        $this->save();
    }

    public function addBalance(int $amount): void
    {
        $this->balance = $this->balance + $amount;
        $this->save();
    }

    public function outgoingTransfers(): HasMany
    {
        return $this->hasMany(TransferHistory::class, 'debit_id');
    }

    public function incomingTransfers(): HasMany
    {
        return $this->hasMany(TransferHistory::class, 'credit_id');
    }

    public function investmentAccount(): HasOne
    {
        return $this->hasOne(InvestmentAccount::class);
    }
}
