<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->redirectTo = route('admin.home');
        $this->middleware('guest:admin', ['except' => 'logout']);
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
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.home'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }

}
