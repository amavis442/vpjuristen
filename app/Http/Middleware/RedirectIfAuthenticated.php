<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;

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
        /** @var User $user */
        $user = Auth::guard($guard)->user();
        if (Auth::guard($guard)->check()) {

            if ($user->isActive() && !$user->hasRole('prospect')){
                if ($user->hasRole('client') || $user->hasRole('debtor')) {
                    return redirect(route('dashboard.home'));
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
