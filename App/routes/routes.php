<?php
return [
    "404" =>[
        "controller"=>"App\Controllers\HomeController",
        "method"=>"display404"
    ],
    "home" => [
        "controller"=>"App\Controllers\HomeController",
        "method"=>"displayHome"
    ],
    "test" => [
        "controller"=> "App\Controllers\TestController",
        "method"=> "displayTest"
    ],
    "db" => [
        "controller"=> "App\Controllers\HomeController",
        "method"=>"displayTestConnection"
    ],
    "404" => [
        "controller"=> "App\Controllers\HomeController",
        "method"=> "display404"
    ],
];