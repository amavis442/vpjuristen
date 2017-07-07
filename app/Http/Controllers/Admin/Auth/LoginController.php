<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->redirectTo = route('admin.home');
        $this->middleware('guest', ['except' => 'logout']);
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
        if (Auth::guard()->attempt($credentials, $remember)) {
            $user = Auth::guard()->user();
            if ($user->hasRole('admin') || $user->hasRole('employee')) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.home'));
            } else {
               redirect()->route('admin.logout');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('admin.login'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
