<?php

namespace app\Controllers;

use root\view;

class AuthController
{
    public function login()
    {
        return view('auth.login', 'Please Loggin for cretae or update posts!');
    }

    public function register()
    {
        return view('auth.register', 'Register and be our friend!');
    }
}