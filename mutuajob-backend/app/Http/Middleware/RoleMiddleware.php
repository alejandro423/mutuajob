<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // verificar si el usuario tiene el rol
        if (method_exists($user, 'hasRole')) {
            $hasRole = $user->hasRole($role);
        } elseif (isset($user->role)) {
            $hasRole = $user->role === $role;
        } else {
            $hasRole = false;
        }

        if (!$hasRole) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}
