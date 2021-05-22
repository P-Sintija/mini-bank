<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function execute(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home.show');
    }
}
