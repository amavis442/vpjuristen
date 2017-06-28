<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = [];
        if (strpos($role,"|")){
            $roles = explode('|', $role);
        } else {
            $roles[] = $role;
        }

        $roleOk = false;
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                $roleOk = true;
            }
        }

        if (!$roleOk) {
            Auth::logout();
            return redirect()->back()->with('warning', 'Not the right permissions');
        }

        return $next($request);
    }

}