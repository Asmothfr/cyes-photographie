<?php
use App\Controllers\LoginController;
use Library\Router;

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
