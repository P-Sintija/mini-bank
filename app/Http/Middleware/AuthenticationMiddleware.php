<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationMiddleware
{
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        if ($id == Auth::id()) {
            return $next($request);
        }
        return redirect()->route('home.show');
    }
}
