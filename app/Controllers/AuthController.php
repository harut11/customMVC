<?php

namespace app\Controllers;

use root\forValidate;
use app\Models\Users;

class AuthController extends forValidate
{
    public function login()
    {
        return view('auth.login', 'Please Loggin for cretae or update posts!');
    }

    public function register()
    {
        return view('auth.register', 'Register and be our friend!');
    }

    public function registerSubmit()
    {
        $this->validate($_REQUEST, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email|unique',
            'password' => 'required|min:6'
        ]);

        Users::query()->create([
            'first_name' => $_REQUEST['first_name'],
            'last_name' => $_REQUEST['last_name'],
            'email' => $_REQUEST['email'],
            'password' => bcrypt($_REQUEST['password']),
            'email_verified' => generate_token()
        ]);

        send_email($_REQUEST['email'], $_REQUEST['email_verified']);
        redirect('/')->setHeader();
    }

    public function verify($request)
    {
        $this->validate($request, [
           'email_verified' => 'required|exists'
        ]);
    }
}