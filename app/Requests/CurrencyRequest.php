<?php
namespace App\Requests;

use App\Models\Currency;

class CurrencyRequest
{
    private Currency $currency;
    private int $amount;
    public function __construct(Currency $currency, int $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
