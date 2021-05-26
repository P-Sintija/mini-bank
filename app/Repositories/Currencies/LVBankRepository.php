<?php

namespace App\Repositories\Currencies;

use App\Models\Currency;

class LVBankRepository implements CurrencyRepository
{
    const BANK_DATA = 'https://www.bank.lv/vk/ecb.xml';

    public function refresh(): void
    {
        $currentCurrenciesXML = file_get_contents(self::BANK_DATA);
        $xmlElements = simplexml_load_string($currentCurrenciesXML);
        $currentCurrenciesJSON = json_encode($xmlElements);
        $currencies = json_decode($currentCurrenciesJSON, true);

        $bankUpdatedAt = $currencies['Date'];
        $databaseUpdatedAt = Currency::pluck('updated_at')->first()->toArray();

        if ($bankUpdatedAt !== date('Ymd', $databaseUpdatedAt['timestamp'])) {
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
