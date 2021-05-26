<?php

namespace App\Http\Controllers;

use App\Services\AuthenticationServices\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    private AuthenticationService $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function show(int $id): View
    {
        return view('authentication.authenticationForm', ['id' => $id]);
    }

    public function verification(Request $request, int $id): RedirectResponse
    {
        if (session()->pull('_authentication') === 'user') {
            return $this->userAuthentication($request, $id);
        }
        return $this->transferAuthentication($request, $id);
    }

    public function update(int $id): View
    {
        $this->authenticationService->refreshCode($id);
        return view('authentication.authenticationForm', ['id' => $id]);
    }

    private function userAuthentication(Request $request, int $id): RedirectResponse
    {
        if ($this->authenticationService->authenticated($request, $id)) {
            Auth::loginUsingId($id);
            return redirect()->route('basicAccount.index', ['id' => $id]);
        }
        return redirect()->route('home.show')
            ->withMessage('Two factor code expired. Please try again!');
    }

    private function transferAuthentication(Request $request, int $id): RedirectResponse
    {
        if ($this->authenticationService->authenticated($request, $id)) {
            return redirect()->route('transfer.execute', ['id' => $id]);
        }
        return redirect()->route('transactionForm.show', ['id' => $id])
            ->withErrors('Authentication code expired. Please try again!');
    }

}
