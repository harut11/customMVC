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
            'first_name' => trim($_REQUEST['first_name']),
            'last_name' => trim($_REQUEST['last_name']),
            'email' => trim($_REQUEST['email']),
            'password' => trim(bcrypt($_REQUEST['password'])),
            'email_verified' => generate_token()
        ]);

        $new_user_arr = Users::query()->maxId();
        $new_user_id = $new_user_arr[0]['MAX(id)'];

        $token_arr = Users::query()->where('id', '=', $new_user_id)->select('email_verified');
        $token = $token_arr[0]['email_verified'];

        send_email($_REQUEST['email'], $token);
        redirect('/')->setHeader();
    }

    public function verify()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $params = parse_url($uri, PHP_URL_QUERY);
        $token = explode('token=', $params);

        $user = Users::query()->where('email_verified', '=', $token[1])->get();
        if ($user) {
            $user_token = $user[0]['email_verified'];

            if($user_token === $token[1]) {
                Users::query()->where('email_verified', '=', $token[1])->update([
                    'email_verified' => null,
                ]);
                return view('email.verified', 'Email verification message');
            }
        }
        return view('email.allready', 'Email is allready verified');
    }
}