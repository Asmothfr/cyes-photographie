<?php
use App\Controllers\LoginController;
use Library\Router;

//Début Chrono
$startChrono = microtime();

spl_autoload_register(function ($className) {
    require (str_replace('\\', '/', $className)) . '.php';
});

session_start();

if(!isset($_SESSION["connected"]))
{
    $home = new LoginController;
    $home->connectionCheaking();
}
else
{

    $router = new Router();
    $router->setup();
}

//Fin Chrono
$stopChrono = microtime();
$resultChrono = floatval ($stopChrono) - floatval ($startChrono);
echo('<p style=color:red;font-size:2rem;>'.$resultChrono.'</p>');