<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;


class LoginController extends \App\Http\Controllers\Auth\LoginController
{
    protected $redirectTo = '/dashboard/home';

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function showLoginFormClient(Request $request)
    {
        return view('dashboard.auth.client');
    }

    public function showLoginFormDebtor(Request $request)
    {
        return view('dashboard.auth.debtor');
    }

}
