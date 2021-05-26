<?php

namespace App\Services\TransferServices\TransactionServices;

use App\Models\BasicAccount;
use App\Models\Currency;
use App\Models\InvestmentAccount;
use App\Models\Stock;
use App\Requests\CurrencyRequest;
use App\Requests\StockRequest;
use App\Services\StockServices\StockService;
use App\Services\TransferServices\ExchangeCurrencyServices\ExchangeCurrenciesService;
use Illuminate\Http\Request;


class TransactionService
{
    private StockService $stockService;
    private ExchangeCurrenciesService $exchangeCurrenciesService;
    const STOCK_MARKET_CURRENCY = 'USD';

    public function __construct(
        StockService $stockService,
        ExchangeCurrenciesService $exchangeCurrenciesService
    )
    {
        $this->stockService = $stockService;
        $this->exchangeCurrenciesService = $exchangeCurrenciesService;
    }

    public function purchase(StockRequest $stock, int $id): bool
    {
        $investmentAccount = BasicAccount::find($id)->investmentAccount;
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


    public function sale(int $id, Request $request): void
    {
        $stock = Stock::find($request['stockId']);
        $investmentAccount = BasicAccount::find($id)->investmentAccount;
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
