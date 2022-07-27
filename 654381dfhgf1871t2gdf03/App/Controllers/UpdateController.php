<?php

namespace App\Controllers;

use App\Models\AboutModel;
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
        $actu = $model->getActuContent();
        $phtDbName = $findPhtName["act_photo"];
        $phtTmpName = $_FILES["act_photo"]["tmp_name"];
        $phtNewName = $_FILES["act_photo"]["name"];
        $dir = "../assets/img/actu_img/";

        //Bug lorsque le formulaire est vide.
        if(isset($_POST["act_title"]) && !empty($_POST["act_title"]) &&
        isset($_POST["act_date"]) && !empty($_POST["act_date"]) &&
        isset($_POST["act_content"]) && !empty($_POST["act_content"]))
        {
            if(isset($_FILES["act_photo"]) && !empty($_FILES["act_photo"]["name"]))
            {
                if(mime_content_type($_FILES["act_photo"]["tmp_name"])=="image/jpeg")
                {
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
                    $errors["updatePhoto"] = "Attention, ce fichier n'est pas une photo";
                    $this->render("actualities",["contents"=>$actu,"errors"=>$errors]);
                }
            }
            else
            {
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
        else
        {
            header("location:index.php?route=actualities");
        }
    }

    public function updateAboutContent()
    {
        echo("<pre>");
        print_r($_POST);
        echo("<br>");

        print_r($_FILES);
        echo("<br>");

        print_r($_GET);
        echo("<br>");
        echo("</pre>");

        $id = $_GET["abt_id"];
        $model = new AboutModel;
        $phtfind = $model->getOnepht($id);
        $phtOldName = $phtfind["abt_photo"];

        switch($_FILES || $_POST)
        {
            case(isset($_FILES["abt_photo"])):
                if(!empty($_FILES["abt_photo"]["name"]) && !empty($_FILES["abt_photo"]["tmp_name"]))
                {   
                    if(mime_content_type($_FILES["abt_photo"]["tmp_name"]) == "image/jpeg")
                    {
                        echo("PHOTO OK");
                        echo("<br>");
                        $phtTmpName = $_FILES["abt_photo"]["tmp_name"];
                        $phtNewName = $_FILES["abt_photo"]["name"];
                        $dir ="../assets/img/about_img/";

                        $column = "abt_photo";
                        $data = [
                            "newData"=>$phtNewName,
                            "id"=>$id
                        ];
                        unlink($dir . $phtOldName);
                        move_uploaded_file($phtTmpName, $dir . $phtNewName);
                        $model->addAboutcontent($column,$data);
                        header("location:index.php?route=about");
                    }
                    else
                    {
                        echo("PAS PHOTO");
                        echo("<br>");
                        $errors = ["Attention, ce fichier n'est pas une photo."];
                    }
                }
                else
                {
                    echo("VIDE");
                    echo("<br>");
                }
                break;
        }
    }
}