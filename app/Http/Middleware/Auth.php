<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (FacadesAuth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // Redirect to the appropriate login page based on the guard
        if (in_array('admin', $guards)) {
            return redirect()->route('admin.login');
        } elseif (in_array('user', $guards)) {
            return redirect()->route('user.login');
        } else {
            return redirect()->route('login'); // Default fallback
        }
    }
}
