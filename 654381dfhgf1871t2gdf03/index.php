<?php

use Library\Router;

spl_autoload_register(function ($className) {
    require lcfirst(str_replace('\\', '/', $className)) . '.php';
});

$router = new Router();
$router->setup();