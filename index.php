<?php

define('base_path', dirname(__FILE__));
define('separator', DIRECTORY_SEPARATOR);

require_once (base_path . separator . 'root' . separator . 'functions.php');

spl_autoload_register(function ($class) {

    $path = dirname(__FILE__) . separator . 'classes' . separator . $class . '.php';

    if(file_exists($path)) {
        require $path;
    } else {
        echo 'Not found' . $class . 'name';
        exit();
    }
});

dd(__FILE__);