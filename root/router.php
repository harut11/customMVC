<?php

namespace root;

class router
{
    use Singleton;

    private function __construct()
    {
        $action = $this->getAction();
        $result = $this->getController()->$action();

        if(is_object($result)) {
            switch (get_class($result)) {
                case 'root\\View':
                    echo $result;
                    break;
                case 'root\\Redirector':
                    $result->setHeader();
                    break;
                default:
                    break;
            }
        }
    }

    private function getController()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = array_values(array_filter(explode('/', $uri)));
        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'home';
        $controllerClassName = "\\app\\controllers\\{$controllerName}Controller";
        return new $controllerClassName;
    }

    private function getAction()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = array_values(array_filter(explode('/', $uri)));
        return count($parts) > 1 ? kebabToCamel($parts[1]): 'index';
    }
}