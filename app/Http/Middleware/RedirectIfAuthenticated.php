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
        $user = Auth::guard($guard)->user();
        if (Auth::guard($guard)->check()) {
            if ($user->isActive()){
                if ($user->hasRole('client') || $user->hasRole('debtor')) {
                    return redirect(route('dashboard.home'));
                }
            }

            if ($user->isActive()){
                if ($user->hasRole('employee')) {
                    return redirect(route('employee.home'));
                }
            }

            if ($user->isActive()){
                if ($user->hasRole('admin')) {
                    return redirect(route('admin.home'));
                }
            }

            return redirect('/home');
        }

        return $next($request);
    }
}
