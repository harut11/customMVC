<?php

namespace root;

class router
{
    use Singleton;

    private function __construct()
    {
        new session();
        $action = self::getAction();
        $result = self::getController()->$action();

        echo $result;
    }

    private function getController()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = array_values(array_filter(explode('/', $uri)));
        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'Home';
        $controllerClassName = "\\app\\Controllers\\{$controllerName}Controller";
        return new $controllerClassName();
    }

    private function getAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = array_values(array_filter(explode('/', $uri)));
        return count($parts) > 1 ? kebabToCamel($parts[1]): 'index';
    }
}