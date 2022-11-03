<?php

use Library\Router;

spl_autoload_register(function ($className) {
    require (str_replace('\\', '/', $className)) . '.php';
});

$router = new Router();
$router->setup();