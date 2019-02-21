<?php

namespace root;

class session
{
    private function __construct()
    {
        session_start();
        $_SESSION['previous_url'] = isset($_SESSION['current_url']) ? $_SESSION['current_url'] : null;
        if (preg_match('/\.(css|js|img|fonts|ico|map)$/', $_SERVER['REQUEST_URI'])) {
            $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
        }
    }

    public static function set($key, $value)
    {
        if(is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }
}