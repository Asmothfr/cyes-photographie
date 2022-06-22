<?php
return [
    "404" =>[
        "App\Controllers\HomeController",
        "display404"
    ],
    "home" => [
        "App\Controllers\HomeController",
        "displayHome"
    ],
    "test" => [
        "App\Controllers\TestController",
        "displayTest"
    ],
    "db" => [
        "App\Controllers\HomeController",
        "displayTestConnection"
    ],
];