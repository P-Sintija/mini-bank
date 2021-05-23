<?php

namespace App\Services\TransferServices\TransactionServices;

use App\Models\Currency;
use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Requests\CurrencyRequest;
use App\Requests\StockRequest;
use App\Services\StockServices\StockMarketService;
use App\Services\StockServices\StockService;
use App\Services\TransferServices\ExchangeCurrencyServices\ExchangeCurrenciesService;


class TransactionService
{
    private StockService $stockService;
    private ExchangeCurrenciesService $exchangeCurrenciesService;
    private StockMarketService $stockMarketService;
    const STOCK_MARKET_CURRENCY = 'USD';

    public function __construct(
        StockService $stockService,
        ExchangeCurrenciesService $exchangeCurrenciesService,
        StockMarketService $stockMarketService
    )
    {
        $this->stockService = $stockService;
        $this->exchangeCurrenciesService = $exchangeCurrenciesService;
        $this->stockMarketService = $stockMarketService;
    }

    public function purchase(StockRequest $stock, InvestmentAccount $investmentAccount): bool
    {
        if ($investmentAccount->currency === self::STOCK_MARKET_CURRENCY) {
            $amount = $stock->costs();
        } else {
            $amount = $this->exchangeCurrencies($stock->costs(), $investmentAccount);
        }

        if ($amount <= $investmentAccount->actual_balance) {
            $this->stockService->store($stock, $investmentAccount);
            $this->buy($investmentAccount, $amount);
            return true;
        }
        return false;
    }


    public function sale(Stock $stock, InvestmentAccount $investmentAccount): void
    {
        if ($investmentAccount->currency === self::STOCK_MARKET_CURRENCY) {
            $amount = $stock->costs;
        } else {
            $amount = $this->exchangeCurrencies($stock->costs, $investmentAccount);
        }
        $this->stockService->delete($stock);
        $this->sell($investmentAccount, $amount);
    }


    private function exchangeCurrencies(int $amount, InvestmentAccount $investmentAccount): int
    {
        $stockMarketCurrency = Currency::where('symbol', self::STOCK_MARKET_CURRENCY)->first();
        $investmentAccountCurrency = Currency::where('symbol', $investmentAccount->currency)->first();
        return $this->exchangeCurrenciesService->exchangeCurrency(
            new CurrencyRequest($stockMarketCurrency, $amount), $investmentAccountCurrency);
    }

    private function buy(InvestmentAccount $investmentAccount, int $amount): void
    {
        $newBalance = $investmentAccount->actual_balance - $amount;
        $investmentAccount->update(['actual_balance' => $newBalance]);
    }

    private function sell(InvestmentAccount $investmentAccount, int $amount): void
    {
        $newBalance = $investmentAccount->actual_balance + $amount;
        $investmentAccount->update(['actual_balance' => $newBalance]);
    }

}
