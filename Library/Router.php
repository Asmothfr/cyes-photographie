<?php

namespace Library;

class Router
{
    public function routerQuery(): void
    {   
        $routes = require "App/paths/paths.php";
    
        $keyRoute = htmlspecialchars($_GET['path'] ?? "home");
    
        if(!isset($routes[$keyRoute]))
        {
            header("location: index.php?path=404");
        }
    
        $routeName = $routes[$keyRoute];
        $controllerName = $routeName[0];
        $methodName = $routeName[1];
        
        $controller = new $controllerName();
        $controller->$methodName();
    }
}