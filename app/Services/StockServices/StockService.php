<?php

namespace App\Services\StockServices;

use App\Http\Requests\StockFormRequest;
use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Repositories\Stocks\FinnhubStockRepository;
use App\Repositories\Stocks\StockRepository;
use App\Requests\StockRequest;
use Illuminate\Database\Eloquent\Collection;


class StockService
{
    private StockRepository $stockRepository;

    public function __construct()
    {
        $this->stockRepository = new FinnhubStockRepository();
    }

    public function stockData(StockFormRequest $request): ?StockRequest
    {
        $currentPrice = $this->stockRepository->getCurrentPrice($request['symbol']);
        if ((int)$currentPrice === 0) {
            return null;
        }
        return new StockRequest(
            (int)($request['number'] * $currentPrice),
            $request['number'],
            $request['symbol']
        );
    }


    public function handle(?Collection $stocks): array
    {
        $stockData = [];
        if($stocks != null) {
            foreach ($stocks as $stock) {
                if (!array_key_exists($stock->symbol, $stockData)) {
                    $stockData[$stock->symbol] = $this->stockRepository->getCurrentPrice($stock->symbol);
                }
            }
            return $stockData;
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
