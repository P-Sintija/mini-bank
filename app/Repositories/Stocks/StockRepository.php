<?php

namespace App\Repositories\Stocks;

use App\Http\Requests\StockFormRequest;
use App\Requests\StockRequest;

interface StockRepository
{
    public function handle(StockFormRequest $request): ?StockRequest;

    public function getCurrentPrice(string $symbol): int;
}
