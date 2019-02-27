<?php

namespace root;

class session
{
    public function __construct()
    {
        session_start();
//        $_SESSION['previous_url'] = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
//        if (!preg_match('/\.(css|js|img|fonts|ico|map)$/', $_SERVER['REQUEST_URI'])) {
//            $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
//        }
    }

    public static function set($key, $value)
    {
        if($key !== 'flush' && is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        $value = !empty($_SESSION[$key]) ? $_SESSION[$key] : null;
        if(json_decode($value)) {
            $value = json_decode($value, true);
        }
        return $value;
    }

    public static function getFlush($key, $param)
    {
        $value = !empty($_SESSION['flush'][$key][$param]) ? $_SESSION['flush'][$key][$param] : null;

        if(is_array($value) || is_object($value)) {
            json_encode($value);
        }
        return $value;
    }

    public static function flush($key, $value)
    {
        $flushed = self::get('flush');
        $flushed = empty($flushed) ? [] : $flushed;

        $flushed[$key] = $value;
        self::set('flush', $flushed);
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
}