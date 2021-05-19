<?php

namespace App\Http\Middleware;


use App\Services\LogInServices\TwoFactorAuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthenticationMiddleware
{

    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        if ($id == Auth::id()) {
            return $next($request);
        }
        return redirect()->route('get.homePage');
    }
}
