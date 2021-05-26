<?php

namespace App\Http\Controllers;


use App\Http\Requests\LogInRequest;
use App\Models\BasicAccount;
use App\Services\AccountServices\BasicAccountServices\BasicAccountService;
use App\Services\AuthenticationServices\AuthenticationService;
use App\Services\AuthenticationServices\PasswordCheckService;
use Illuminate\Http\RedirectResponse;


class LogInController extends Controller
{
    private BasicAccountService $basicAccountService;
    private PasswordCheckService $passwordCheckService;
    private AuthenticationService $authenticationService;

    public function __construct(
        BasicAccountService $basicAccountService,
        PasswordCheckService $passwordCheckService,
        AuthenticationService $authenticationService
    )
    {
        $this->basicAccountService = $basicAccountService;
        $this->passwordCheckService = $passwordCheckService;
        $this->authenticationService = $authenticationService;
    }

    public function logIn(LogInRequest $request): RedirectResponse
    {
        $user = $this->basicAccountService->getByUserId($request);
        if ($this->passwordCheckService->validate($user, $request->request->get('password'))) {
            session()->put('_authentication', 'user');
            $this->authenticationService->sendTwoFactorCode($user->id);
            return redirect()->route('authenticationForm.show', ['id' => $user->id]);
        };
        return redirect()->route('home.show')
            ->withErrors('Password was incorrect!');
    }

}
