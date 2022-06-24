<?php
return [
    "404" =>[
        "controller"=>"App\Controllers\FrontController",
        "method"=>"display404"
    ],
    "home" => [
        "controller"=>"App\Controllers\FrontController",
        "method"=>"displayHome"
    ],
    "galleries" => [
        "controller"=> "App\Controllers\FrontController",
        "method"=> "displayAlbums"
    ],
    "photos" => [
        "controller"=> "App\Controllers\FrontController",
        "method"=> "displayPhotos"
    ],
];