<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->redirectTo = route('admin.home');
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function login(Request $request)
    {
        $this->validate($request, ['email'=>'required|string|email|max:255', 'password' => 'required|string|min:6']);

        $credentials['email'] = $request->get('email');
        $credentials['password'] = $request->get('password');
        $remember = $request->get('remember');

        if (Auth::guard()->attempt($credentials, $remember)) {
            $user = Auth::guard()->user();
            if ($user->isAdmin() || $user->isEmployee()) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.home'));
            } else {
               redirect()->route('logout');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.admin.login');
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
