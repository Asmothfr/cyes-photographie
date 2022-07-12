<?php
return [
    "404" =>[
        "controller"=>"App\Controllers\DisplayController",
        "method"=>"display404"
    ],
    "login" => [
        "controller"=> "App\Controllers\LoginController",
        "method"=> "connectionCheaking"
    ],
    "logout" => [
        "controller"=> "App\Controllers\LoginController",
        "method"=> "logout"
    ],
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
    "mails" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayMails"
    ],
    "mail" => [
        "controller"=> "App\Controllers\DisplayController",
        "method"=> "displayOneMail"
    ],
    "addCategorie" => [
        "controller"=> "App\Controllers\AddController",
        "method"=> "addOneCategorie"
    ],
    "addAlbum" => [
        "controller"=> "App\Controllers\AddController",
        "method"=> "addOneAlbum"
    ],
    "addPhotos" => [
        "controller"=> "App\Controllers\AddController",
        "method"=> "addPhotos"
    ],
    "deleteMail" => [
        "controller"=> "App\Controllers\DeleteController",
        "method"=> "deleteOneMail"
    ],
    "deletePhoto" => [
        "controller"=> "App\Controllers\DeleteController",
        "method"=> "deleteOnePhoto"
    ],
    "deleteAlbum" => [
        "controller"=> "App\Controllers\DeleteController",
        "method"=> "DeleteOneAlbum"
    ],
    "deleteCategorie" => [
        "controller"=> "App\Controllers\DeleteController",
        "method"=> "deleteOneCategorie"
    ],
];