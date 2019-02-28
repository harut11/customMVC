<?php

namespace root;

class router
{
    use Singleton;

    private function __construct()
    {
        new session();
        $this->getAction();
    }

    private function getController($action)
    {
        $controllerName = null;

        switch ($action) {
            case 'login':
                middleware('auth');
                $controllerName = 'Auth';
                break;
            case 'register':
                middleware('auth');
                $controllerName = 'Auth';
                break;
            case 'logout':
                middleware('auth');
                $controllerName = 'Auth';
                break;
            case 'index':
                session::delete('flush');
                $controllerName = 'Home';
                break;
            case 'registerSubmit':
                middleware('auth');
                $controllerName = 'Auth';
                break;
            case 'verify':
                $controllerName = 'Auth';
                break;
            case 'loginSubmit':
                middleware('auth');
                $controllerName = 'Auth';
        }

        $controllerClassName = "\\app\\Controllers\\{$controllerName}Controller";
        return new $controllerClassName();
    }

    private function getAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $path = explode('/', parse_url($uri, PHP_URL_PATH));

        $action =  $path[1] ? kebabToCamel($path[1]): 'index';

        return $this->getController($action)->$action();
    }
}