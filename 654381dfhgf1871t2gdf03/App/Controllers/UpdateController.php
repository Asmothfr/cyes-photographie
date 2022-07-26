<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Library\LayoutController;

class UpdateController extends LayoutController
{
    public function AdminInfoUpdate()
    {
        $errors = [];
        $id = $_GET["adm_id"];
        $model = new AdminModel;
        switch($_POST)
        {
            case isset($_POST["login"]):
                if(!empty($_POST["login"]))
                {
                    $column = "adm_login";
                    $data = $_POST["login"];
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    $errors["login"] = "Veuillez remplir le champs login avant de valider.";
                }
                break;
            case isset($_POST["password"]) && isset($_POST["password_confirmation"]):
                if(!empty($_POST["password"]) && !empty($_POST["password_confirmation"]) && 
                    $_POST["password"] == $_POST["password_confirmation"])
                {
                    $column = "adm_password";
                    $data = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    $errors["password"] = "Les mots de passe ne sont pas identiques";
                }
                break;
            case isset($_POST["lastname"]):
                if(!empty($_POST["lastname"]))
                {
                    $column = "adm_last_name";
                    $data = $_POST["lastname"];
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    $errors["lastname"] = "Veuillez renseigner votre Nom avant de valider.";
                }
                break;
            case isset($_POST["firstname"]):
                if(!empty($_POST["firstname"]))
                {
                    $column = "adm_first_name";
                    $data = $_POST["firstname"];
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    $errors["firstname"] = "Veuillez renseigner votre Prénom avant de valider.";
                }
                break;
        }
        if(isset($errors) && !empty($errors))
        {
            $admin = $model->adminInfo();
            $this->render("administrator",["admin"=>$admin,"errors"=>$errors]);
        }
    }
}