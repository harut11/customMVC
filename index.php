<?php

define('base_path', dirname(__FILE__));
define('separator', DIRECTORY_SEPARATOR);

require_once (base_path . separator . 'root' . separator . 'functions.php');

spl_autoload_register(function ($class) {

    $path = base_path($class) . '.php';

    if(file_exists($path)) {
        require_once $path;
    } else {
        redirect('/')->setHeader();
    }
});

getRouter();