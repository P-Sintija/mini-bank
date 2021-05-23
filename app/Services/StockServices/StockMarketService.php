<?php

namespace App\Services\StockServices;

use App\Http\Requests\StockFormRequest;
use App\Requests\StockRequest;
use Finnhub;
use GuzzleHttp;

class StockMarketService
{
    const STOCK_CURRENT_PRICE = 'c';
    const API_KEY = 'c1n9rna37fkt0cimnp8g';


    public function handle(StockFormRequest $request): ?StockRequest
    {
        $currentPrice = $this->getCurrentPrice($request['symbol']);
        if ((int)$currentPrice === 0) {
            return null;
        }
        return new StockRequest(
            (int)($request['number'] * $currentPrice),
            $request['number'],
            $request['symbol']
        );
    }

    public function getCurrentPrice(string $symbol): int
    {
        $config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', self::API_KEY);
        $client = new Finnhub\Api\DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        return $client->quote($symbol)[self::STOCK_CURRENT_PRICE] * 100;
    }
}
