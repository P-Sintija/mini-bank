<?php

namespace App\Services\TransferServices;


use App\Http\Requests\TransferFormRequest;
use App\Models\BasicAccount;
use App\Models\Currency;
use App\Requests\CurrencyRequest;
use App\Requests\TransferRequest;

class TransferContentService
{
    private ExchangeCurrenciesService $exchangeCurrenciesService;

    public function __construct(
        ExchangeCurrenciesService $exchangeCurrenciesService
    )
    {
        $this->exchangeCurrenciesService = $exchangeCurrenciesService;
    }

    public function handle(BasicAccount $debitAccount, TransferFormRequest $request): TransferRequest
    {
        $debit = $request->request->get('amount');
        $creditAccount= BasicAccount::where('account_number', $request->request->get('account_number'))->first();
        $debitCurrency = Currency::where('symbol', $debitAccount->currency)->first();
        $creditCurrency = Currency::where('symbol', $creditAccount->currency)->first();

        $credit = $this->exchangeCurrenciesService->exchangeCurrency(
            new CurrencyRequest($debitCurrency, $debit), $creditCurrency);

        return new TransferRequest($debitAccount, $debit, $creditAccount, $credit);
    }



}
