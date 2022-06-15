<?php
require '../vendor/autoload.php';

spl_autoload_register(function ($class) {


    $class = str_replace(
        [
            '\\',
            "Core",
            "App/Controller",
            'App/Model',
            'App/Entity',
            'App/Service',
            'App/DTO'

        ],
        [
            '/',
            '../core',
            '../src/Controller',
            '../src/Model',
            '../src/Entity',
            '../src/Service',
            '../src/DTO'

        ],
        $class


    );
    $class .= '.php';
    
    require_once "$class";
});


if (!empty($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']);
} else {
    $controller = 'Home';
}


$controller = '\\App\\Controller\\'. $controller . 'Controller';

$controller = new $controller();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

if (method_exists($controller, $action)) {
    $controller->$action(); // index() soit autre
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Erreur 404 Not Found test1";
}


