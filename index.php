<?php

use Library\Router;

//Début Chrono
$startChrono = microtime();

spl_autoload_register(function ($className) {
    require (str_replace('\\', '/', $className)) . '.php';
});

$router = new Router();
$router->setup();

//Fin Chrono
$stopChrono = microtime();
$resultChrono = floatval ($stopChrono) - floatval ($startChrono);
echo('<p style=color:red;font-size:2rem;>'.$resultChrono.'</p>');