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
    "galleries" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayAlbums"
    ],
    "photos" => [
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
];