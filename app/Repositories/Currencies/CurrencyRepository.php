<?php

namespace App\Repositories\Currencies;

interface CurrencyRepository
{
    public function refresh(): void;
}
