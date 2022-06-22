<?php

spl_autoload_register(function ($className) {
    require lcfirst(str_replace('\\', '/', $className)) . '.php';
});

echo "<pre>MegaTest 2</pre>";
$connect = new Database;