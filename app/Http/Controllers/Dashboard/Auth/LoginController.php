<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->redirectTo = route('dashboard.home');
        $this->middleware('guest:dashboard', ['except' => 'logout']);
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required:min:6'
        ]);

        $credentials['email'] = $request->get('email');
        $credentials['password'] = $request->get('password');
        $remember = $request->get('remember');
        if (Auth::guard('dashboard')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard.home'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showLoginForm(Request $request)
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
