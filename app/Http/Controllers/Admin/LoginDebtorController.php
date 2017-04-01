<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/1/17
 * Time: 7:59 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Request;

class LoginDebtorController
{
    public function showLoginForm(Request $request)
    {
        return view('admin.auth.debtor');
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