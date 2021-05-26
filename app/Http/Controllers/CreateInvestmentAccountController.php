<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestmentFormRequest;
use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use App\Services\AccountServices\InvestmentsAccountsServices\CreateInvestmentAccountService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CreateInvestmentAccountController extends Controller
{
    private BasicAccountService $basicAccountService;
    private CreateInvestmentAccountService $investmentAccountService;

    public function __construct(
        BasicAccountService $basicAccountService,
        CreateInvestmentAccountService $investmentAccountService
    )
    {
        $this->basicAccountService = $basicAccountService;
        $this->investmentAccountService = $investmentAccountService;
    }

    public function show(int $id): View
    {
        $user = $this->basicAccountService->handle($id);
        $accountNumber = $this->investmentAccountService->accountNumber();
        return view('investment-account.investmentAccountForm', [
            'account' => $user,
            'investmentAccountNumber' => $accountNumber
        ]);
    }

    public function store(int $id, InvestmentFormRequest $request): RedirectResponse
    {
        $this->investmentAccountService->execute($request, $id);
        return redirect()->route('investmentAccount.index', ['id' => $id]);
    }

}
