<?php

namespace App\Services\StockServices;

use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Requests\StockRequest;
use Illuminate\Database\Eloquent\Collection;


class StockService
{
    private StockMarketService $stockMarketService;

    public function __construct(StockMarketService $stockMarketService)
    {
        $this->stockMarketService = $stockMarketService;
    }

    public function handle(Collection $stocks): array
    {
        $stockData = [];
        foreach($stocks as $stock){
            if(!array_key_exists($stock->symbol, $stockData)){
                $stockData[$stock->symbol] = $this->stockMarketService->getCurrentPrice($stock->symbol);
            }
        }
        return $stockData;
    }

    public function store(StockRequest $stock, InvestmentAccount $investmentAccount): void
    {
        $stockData = $this->handleData($stock, $investmentAccount);
        $stock = new Stock($stockData);
        $stock->save();
    }

    public function delete(Stock $stock): void
    {
        $stock->delete();
    }


    private function handleData(StockRequest $stock, InvestmentAccount $investmentAccount): array
    {
        return [
            'investment_account_id' => $investmentAccount->id,
            'costs' => $stock->costs(),
            'number_of' => $stock->numberOf(),
            'symbol' => $stock->symbol()
        ];
    }
}
