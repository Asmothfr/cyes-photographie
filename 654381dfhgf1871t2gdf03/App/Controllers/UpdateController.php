<?php

namespace App\Controllers;

use App\Models\ActualitiesModel;
use App\Models\AdminModel;
use Library\LayoutController;

class UpdateController extends LayoutController
{
    public function AdminInfoUpdate():void
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
                    $data = [
                        "newData"=>$_POST["login"],
                        "id"=>$id
                    ];
                    $model->adminUpdate($column,$data);
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
                    $data = [
                        "newData"=>password_hash($_POST["password"], PASSWORD_BCRYPT),
                        "id"=>$id
                    ];
                    $model->adminUpdate($column,$data);
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
                    $data = [
                        "newData"=>$_POST["lastname"],
                        "id"=>$id
                    ];
                    $model->adminUpdate($column,$data);
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
                    $data = [
                        "newData"=>$_POST["firstname"],
                        "id"=>$id
                    ];
                    $model->adminUpdate($column,$data);
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

    public function updateActualitie():void
    {

        $id = $_GET["act_id"];
        $model = new ActualitiesModel;
        $findPhtName = $model->getPhtName($id);
        $phtDbName = $findPhtName["act_photo"];
        $phtTmpName = $_FILES["act_photo"]["tmp_name"];
        $phtNewName = $_FILES["act_photo"]["name"];
        $dir = "../assets/img/actu_img/";

        echo("<pre>");
        print_r($_FILES);
        echo("</pre>");
        echo("<br>");


        if(isset($_POST["act_title"]) && !empty($_POST["act_title"]) &&
        isset($_POST["act_date"]) && !empty($_POST["act_date"]) &&
        isset($_POST["act_content"]) && !empty($_POST["act_content"]))
        {
            if(isset($_FILES["act_photo"]) && !empty($_FILES["act_photo"]["name"]))
            {
                echo("condition photo ok");
                $data = [
                    "title"=>$_POST['act_title'],
                    "content"=>$_POST["act_content"],
                    "dat"=>$_POST["act_date"],
                    "photo"=>$_FILES["act_photo"]["name"],
                    "id"=>$id
                ];
                unlink($dir . $phtDbName);
                move_uploaded_file($phtTmpName, $dir . $phtNewName);
                $model->updateActualitie($data);
                header("location:index.php?route=actualities");
            }
            else
            {
                echo("condition photo vide");
                $data = [
                    "title"=>$_POST['act_title'],
                    "content"=>$_POST["act_content"],
                    "dat"=>$_POST["act_date"],
                    "photo"=>$phtDbName,
                    "id"=>$id
                ];
                $model->updateActualitie($data);
                header("location:index.php?route=actualities");
            }
        }
    }
}