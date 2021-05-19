<?php

namespace App\Http\Controllers;

use App\Models\BasicAccount;

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
        return view('authenticationForm', ['id' => $id]);
    }

    public function verification(Request $request, int $id): RedirectResponse
    {
        var_dump(session()->all());

        $user = BasicAccount::find($id);
        if (session()->pull('_authentication') === 'user') {
            return $this->userAuthentication($request, $user);
        }
        return $this->transferAuthentication($request, $user);

    }

    public function create(int $id): View
    {
        $user = BasicAccount::find($id);
        $this->authenticationService->refreshCode($user);
        return view('authenticationForm', ['id' => $id]);
    }

    private function userAuthentication(Request $request, BasicAccount $user): RedirectResponse
    {
        if ($this->authenticationService->authenticated($request, $user)) {
            Auth::loginUsingId($user->id);
            return redirect()->route('basicAccount.show', ['id' => $user->id]);
        }
        return redirect()->route('home.show')->withMessage('Two factor code expired. Please try again!');
    }

    private function transferAuthentication(Request $request, BasicAccount $user): RedirectResponse
    {
        if ($this->authenticationService->authenticated($request, $user)) {
            return redirect()->route('transfer.execute', ['id' => $user->id]);
        }
        return redirect()->route('transactionForm.show', ['id' => $user->id])->withErrors('Authentication code expired. Please try again!');
    }

}
