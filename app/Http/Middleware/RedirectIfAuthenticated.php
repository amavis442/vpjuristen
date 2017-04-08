<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee')) {
                return redirect('/admin/home');
            }
            if (Auth::user()->hasRole('client') || Auth::user()->hasRole('debtor')) {
                return redirect('/dashboard/home');
            }

            return redirect('/home');
        }

        return $next($request);
    }
}
