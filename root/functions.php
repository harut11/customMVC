<?php

function dd(... $values) {
    foreach ($values as $value) {
        var_dump($value);
        exit();
    }
}

function redirect($url) {
    return new root\redirector($url);
}

function cebabToCamel($text) {
    $parts = explode('-', $text);
    foreach ($parts as $key => $part) {
        if($key !== 0) {
            $parts[$key] = ucfirst($part);
        }
    }
    return implode('', $parts);
}