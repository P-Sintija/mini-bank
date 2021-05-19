<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CurrenciesSeeder extends Seeder
{
    public function run()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->integer('rate');
            $table->timestamps();
        });

        $currentCurrenciesXML = file_get_contents('https://www.bank.lv/vk/ecb.xml');
        $xmlElements = simplexml_load_string($currentCurrenciesXML);
        $currentCurrenciesJSON = json_encode($xmlElements);
        $currencies = json_decode($currentCurrenciesJSON, true);

        foreach ($currencies['Currencies']['Currency'] as $currency) {
            Currency::updateOrCreate(
                ['symbol' => $currency['ID']],
                ['symbol' => $currency['ID'],
                    'rate' => (int)((float)$currency['Rate'] * 100000)
                ]);
        }

        Currency::create([
            'symbol'=> 'EUR',
            'rate' => '100000'
        ]);
    }
}
