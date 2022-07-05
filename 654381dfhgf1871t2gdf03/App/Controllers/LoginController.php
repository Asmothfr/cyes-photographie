<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\AdminModel;

class LoginController extends LayoutController
{
    public function connectionCheaking()
    {

        $model = new AdminModel();
        $admin = $model -> adminInfo();

        if(isset($_POST["login"]) && !empty($_POST["login"]) && $_POST["login"] == $admin["adm_login"] && 
           isset($_POST["password"]) && !empty($_POST["password"])  && password_verify($_POST["password"], $admin["adm_password"]))
        {
            $_SESSION["connected"] = true;
            $this->render("home");
        }
        else
        {
            $error = "Les champs ont mal était renseigné.";
            $this->render("home");
        }
    }
    public function logout()
    {
        session_destroy();
        header("location: index.php?route=home");
    }
}