<?php

spl_autoload_register(function ($class) {
    $separator = DIRECTORY_SEPARATOR;
    $path = dirname(__FILE__) . $separator . 'classes' . $separator . $class . '.php';

    if(file_exists($path)) {
        require $path;
    } else {
        echo 'Not found' . $class . 'name';
        exit();
    }
});