<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    public function handle($request, Closure $next)
{
    $user = Auth::user();

    if ($user && $user->google2fa_enabled) {

        if (!session('2fa_passed')) {
            return redirect('/2fa');
        }
    }

    return $next($request);
}
}
