<?php

namespace app\Controllers;

use root\view;
use root\forValidate;

class AuthController extends forValidate
{
    public function login()
    {
        $this->validate('sdfsfsdf', [
           'name' => 'required|min:20|max:50|unique',
        ]);
        return view('auth.login', 'Please Loggin for cretae or update posts!');
    }

    public function register()
    {
        return view('auth.register', 'Register and be our friend!');
    }
}