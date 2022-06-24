<?php

namespace App\Controllers;

use Library\LayoutController;

class HomeController extends LayoutController
{
    public function display404(): void
    {
        require_once "App/views/404.phtml";
    }

    public function displayHome(): void
    {
        // $view = "home";
        // require_once "/views/homeLayout.phtml";
        $this->render("home");
    }

    public function displayTestConnection(): void
    {
        $this->render("testConnectionDb");
    }
}