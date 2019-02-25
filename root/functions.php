<?php

function dd(...$values) {
    foreach ($values as $value) {
        var_dump($value);
        exit();
    }
}

function redirect($url) {
    return new root\redirector($url);
}

function kebabToCamel($text) {
    $parts = explode('-', $text);
    foreach ($parts as $key => $part) {
        if($key !== 0) {
            $parts[$key] = ucfirst($part);
        }
    }
    return implode('', $parts);
}

function replace_separators($path) {
    return preg_replace('#[\\\/]#', separator, $path);
}

function base_path($path) {
    return replace_separators(base_path . '/' . $path);
}

function app_path($path) {
    return base_path('app/' . $path);
}

function views_path($path) {
    return app_path('Views/' . $path);
}

function view($view, $title) {
    $viewObj = new \root\view();
    echo $viewObj->showView($view, $title);

}

function getRouter() {
    return \root\router::getInstance();
}

function get_connection() {
    return \root\Database\connection::getInstance();
}

function bcrypt($text) {
    return sha1($text);
}

function send_email($email, $token) {
    $obj =  new \root\mail($email, $token);
    $obj->sendMessage();
}

function generate_token($length = 40) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);

    $randomText = '';

    for ($i = 0; $i < $length; $i++) {
        $randomText .= $chars[rand(0, $charLength - 1)];
    }
    return $randomText;
}