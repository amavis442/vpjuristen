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

class LoginDebtorController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function showLoginForm(Request $request)
    {
        return view('dashboard.auth.debtor');
    }

    public function login()
    {
        return view('admin.auth.debtor');
    }


    protected function validateLogin($typeLogin, Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }
}