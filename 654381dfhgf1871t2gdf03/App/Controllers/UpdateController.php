<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Library\LayoutController;

class UpdateController extends LayoutController
{
    public function AdminInfoUpdate()
    {
        // print_r($_POST);
        // echo("<br>");
        // print_r($id);
        // // die;
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
                    echo("ERREUR 1");
                    echo("<br>");
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
                    echo("ERREUR 2");
                    echo("<br>");
                    $errors["password"] = "Les mots de passe ne sont pas identiques";
                }
                break;
            case isset($_POST["lastname"]):
                if(!empty($_POST["lastname"]))
                {
                    echo("OK 3");
                    echo("<br>");
                    $column = "adm_last_name";
                    $data = $_POST["lastname"];
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    echo("ERREUR 3");
                    echo("<br>");
                    $errors["lastname"] = "Veuillez renseigner votre Nom avant de valider.";
                }
                break;
            case isset($_POST["firstname"]):
                if(!empty($_POST["firstname"]))
                {
                    echo("OK 4");
                    echo("<br>");
                    $column = "adm_first_name";
                    $data = $_POST["firstname"];
                    $model->adminUpdate($column,$data,$id);
                    header("location:index.php?route=admin");
                }
                else
                {
                    echo("ERREUR 4");
                    echo("<br>");
                    $errors["firstname"] = "Veuillez renseigner votre Prénom avant de valider.";
                }
                break;
        }
        if(isset($errors) && !empty($errors))
        {
            echo("AFFICHE LES ERREURS");
            echo("<br>");
            echo("<pre>");
            print_r($errors);
            echo("</pre>");
            $admin = $model->adminInfo();
            $this->render("administrator",["admin"=>$admin,"errors"=>$errors]);
        }
    }
}