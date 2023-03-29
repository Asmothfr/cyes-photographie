<?php

namespace Library;

class Tools
{
    public function echoArray($array)
    {
        echo("<pre>");
        print_r($array);
        echo("</pre>");
        echo("<br>");
    }
}