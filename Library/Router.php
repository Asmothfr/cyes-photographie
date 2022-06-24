<?php

namespace Library;

use Controller;

class Router
{   

    // Instancie le bon controlleur et sa méthode en fonction de la route.
    public function setup(): void
    {   
        $routes = require "App/routes/routes.php";
    
        $queriedRoute = htmlspecialchars($_GET['route'] ?? "home");
    
        if(!isset($routes[$queriedRoute]))
        {
            header("location: index.php?route=404");
        }
    
        $routeName = $routes[$queriedRoute];
        $controller = $routeName["controller"];
        $method = $routeName["method"];
        
        $display = new $controller();
        $display->$method();
    }
}