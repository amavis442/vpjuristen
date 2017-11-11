<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRouteRoles
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string                   $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        switch ($role) {
            case 'employee':
                $roleOk = $request->user()->isAdmin();
                break;
            case 'manager':
                $roleOk = $request->user()->isAdmin();
                break;
            case 'admin':
                $roleOk = $request->user()->isAdmin();
                break;
            default:
                $roleOk = false;
                break;
        }

        if (!$roleOk) {
            Auth::logout();

            return redirect()->back()->with('warning', 'Not the right permissions');
        }

        return $next($request);
    }

}