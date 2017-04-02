<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/1/17
 * Time: 7:59 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginClientController extends Controller
{
    use AuthenticatesUsers {
        login as public parentLogin;
    }

    protected $redirectTo = '/dashboard';

    public function showLoginForm(Request $request)
    {
        return view('dashboard.auth.client');
    }

    public function login(Request $request)
    {
        $result = $this->parentLogin($request);

        $isOk = $this->attemptLogin($request);

        if ($isOk) {
            //Auth::user()->
        }

        return $result;
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }
}