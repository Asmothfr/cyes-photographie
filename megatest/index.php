<?php 
spl_autoload_register(function ($className) {
    require lcfirst(str_replace('\\', '/', $className)) . '.php';
});

    $display = new Controller();
    $display->displayTest($model=[]);
?>