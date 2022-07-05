<?php
return [
    "404" =>[
        "controller"=>"App\Controllers\DisplayController",
        "method"=>"display404"
    ],
    "home" => [
        "controller"=>"App\Controllers\DisplayController",
        "method"=>"displayHome"
    ],
    "album" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayAlbums"
    ],
    "gallery" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayPhotos"
    ],
    "about" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayAbout"
    ],
    "actualities" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayActualities"
    ],
    "login" => [
        "controller"=> "App\Controllers\LoginController",
        "method"=> "connectionCheaking"
    ],
    "logout" => [
        "controller"=> "App\Controllers\LoginController",
        "method"=> "logout"
    ],
];