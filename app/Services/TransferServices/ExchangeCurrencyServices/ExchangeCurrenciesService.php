<?php

namespace App\Services\TransferServices\ExchangeCurrencyServices;

use App\Models\Currency;
use App\Requests\CurrencyRequest;


class ExchangeCurrenciesService
{
    const BANK_DEFAULT_CURRENCY = 'EUR';

    public function exchangeCurrency(CurrencyRequest $debit, Currency $creditCurrency): int
    {
        $this->refreshData();

        if ($debit->getCurrency()['symbol'] === self::BANK_DEFAULT_CURRENCY &&
            $debit->getCurrency()['symbol'] !== $creditCurrency->symbol) {
            return $this->EURToCurrency($debit, $creditCurrency);
        } else if ($creditCurrency->symbol === self::BANK_DEFAULT_CURRENCY &&
            $debit->getCurrency()['symbol'] !== $creditCurrency->symbol) {
            return $this->CurrencyToEUR($debit);
        } else if ($debit->getCurrency()['symbol'] !== self::BANK_DEFAULT_CURRENCY &&
            $creditCurrency->symbol !== self::BANK_DEFAULT_CURRENCY) {
            return $this->CurrencyToCurrency($debit, $creditCurrency);
        }
        return $debit->getAmount();
    }


    private function EURToCurrency(CurrencyRequest $debit, Currency $creditCurrency): int
    {
        $rate = Currency::where('symbol', $creditCurrency->symbol)->pluck('rate');
        return ($rate[0] * (int)($debit->getAmount())) / 100000;
    }

    private function CurrencyToEUR(CurrencyRequest $debit): int
    {
        $rate = Currency::where('symbol', $debit->getCurrency()['symbol'])->pluck('rate');
        return (((int)($debit->getAmount() * 1000) / $rate[0]) * 100);
    }

    private function CurrencyToCurrency(CurrencyRequest $debit, Currency $creditCurrency): int
    {
        $amountEUR = $this->CurrencyToEUR($debit);
        $rate = Currency::where('symbol', $creditCurrency->symbol)->pluck('rate');
        return ($rate[0] * (int)$amountEUR) / 100000;
    }

    private function refreshData(): void
    {
        $currentCurrenciesXML = file_get_contents('https://www.bank.lv/vk/ecb.xml');
        $xmlElements = simplexml_load_string($currentCurrenciesXML);
        $currentCurrenciesJSON = json_encode($xmlElements);
        $currencies = json_decode($currentCurrenciesJSON, true);

        $bankUpdatedAt = $currencies['Date'];
        $databaseUpdatedAt = Currency::pluck('updated_at')->first()->toArray();

        if($bankUpdatedAt !== date ( 'Ymd' , $databaseUpdatedAt['timestamp'])){
            foreach ($currencies['Currencies']['Currency'] as $currency) {
                Currency::updateOrCreate(
                    ['symbol' => $currency['ID']],
                    ['symbol' => $currency['ID'],
                        'rate' => (int)((float)$currency['Rate'] * 100000)
                    ]);
            }
        }
    }

}
