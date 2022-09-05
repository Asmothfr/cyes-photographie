<?php
return [
    "home" => [
        "controller"=>"App\Controllers\DisplayController",
        "method"=>"displayHome"
    ],
    "albums" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayAlbums"
    ],
    "gallery" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayGallery"
    ],
    "about" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayAbout"
    ],
    "actualities" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayActualities"
    ],
    "contact" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayContact"
    ],
    "validation" => [
        "controller"=> "App\Controllers\FormController",
        "method"=> "FormValidation"
    ],
];