<?php

namespace Library;

class Tools
{
    static public function echoArray(array $array):void
    {
        echo("<pre>");
        print_r($array);
        echo("</pre>");
        echo("<br>");
    }

    static public function redirect(string $routeName):void
    {
        header("location:$routeName");
    }
}