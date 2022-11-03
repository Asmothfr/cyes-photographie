<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\AdminModel;

class LoginController extends LayoutController
{
    public function connectionCheaking()
    {
        if(isset($_POST["login"]) && !empty($_POST["login"]) && 
           isset($_POST["password"]) && !empty($_POST["password"]))
        {

            $model = new AdminModel();
            $admin = $model -> adminInfo();
            if($_POST["login"] == $admin["adm_login"] && password_verify($_POST["password"], $admin["adm_password"]))
            {
                echo("condition ok");
                $_SESSION["connected"] = true;
                header("location:home");
            }
            else
            {
                header("location:home");
            }
        }
        else
        {
        $this->render("home");
        }
    }
    public function logout()
    {
        session_destroy();
        header("location:home");
    }
}