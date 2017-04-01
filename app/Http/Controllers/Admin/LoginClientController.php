<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 4/1/17
 * Time: 7:59 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Request;

class LoginClientController
{
    public function showLoginForm(Request $request)
    {
        return view('admin.auth.login');
    }



    public function login()
    {
        return view('admin.auth.client');
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }
}