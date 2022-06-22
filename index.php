<?php

use Library\Router;

session_start();

spl_autoload_register(function ($className) {
    require lcfirst(str_replace('\\', '/', $className)) . '.php';
});

$router = new Router();
$router->routerQuery();