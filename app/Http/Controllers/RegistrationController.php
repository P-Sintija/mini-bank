<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\Currency;
use App\Services\NewCostumerServices\CreateBasicAccService;
use App\Services\NewCostumerServices\EmailVerificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{
    private CreateBasicAccService $createBasicAccService;
    private EmailVerificationService $emailVerificationService;

    public function __construct(
        CreateBasicAccService $createBasicAccService,
        EmailVerificationService $emailVerificationService
    )
    {
        $this->createBasicAccService = $createBasicAccService;
        $this->emailVerificationService = $emailVerificationService;
    }

    public function show(): View
    {
        $currencies = Currency::orderby('symbol', 'desc')->get();
        return view('registrationForm', [
            'currencies' => $currencies->reverse()
        ]);
    }

    public function validation(RegistrationFormRequest $request): RedirectResponse
    {
        $this->emailVerificationService->sendVerification($request->all());
        return redirect()->route('home.show')
            ->withMessage('Please check your mail!');
    }

    public function create(Request $request): RedirectResponse
    {
        if ($this->createBasicAccService->stored($request)) {
            return redirect()->route('home.show')
                ->withMessage('Registration was successful. Please log in!');
        };
        return redirect()->route('home.show')
            ->withMessage('Something went wrong. Please try again!');
    }

}
