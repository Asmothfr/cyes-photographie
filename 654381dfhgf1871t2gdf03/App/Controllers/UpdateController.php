<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\AdminModel;
use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use Library\LayoutController;

class UpdateController extends LayoutController
{
    /*
        Vérification individuelle des formulaires de la pages "administrator".
        Met à jours la colonne ciblé en base de donné.
    */
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
                    header("location:admin");
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
                    header("location:admin");
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
                    header("location:admin");
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
                    header("location:admin");
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
        $errors = [];

        if(isset($_POST["act_title"]) && !empty($_POST["act_title"]) &&
        isset($_POST["act_date"]) && !empty($_POST["act_date"]) &&
        isset($_POST["act_content"]) && !empty($_POST["act_content"]))
        {
            if(isset($_FILES["act_photo"]) && !empty($_FILES["act_photo"]["name"]))
            {
                $imgInfo = getimagesize($_FILES["act_photo"]["tmp_name"]);
                switch($imgInfo)
                {
                    case $imgInfo === "false" || false:
                        $errors["updatePhoto"] = "Attention, ce fichier n'est pas une photo";
                        break;
                    case $imgInfo["mime"] !== "image/jpeg":
                        $errors["updatePhoto"] = "Veuillez téléverser une photo au format .jpeg ou .jpg";
                        break;
                    case $imgInfo["3"] !== 'width="250" height="250"':
                        $errors["updatePhoto"] = "Veuillez téléverser une photo au format 250x250 pixels";
                        break;
                    default:
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
                        header("location:actualities");
                }
                if(isset($errors)&&!empty($errors))
                {
                    $this->render("actualities",["contents"=>$actu,"errors"=>$errors,"id"=>$id]);
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
                header("location:actualities");
            }
        }
        else
        {
            header("location:actualities");
        }
    }
/*
        Vérification individuelle des formulaires de la pages "about".
        Met à jours la colonne ciblé en base de donné.
    */
    public function updateAboutContent():void
    {
        $id = $_GET["abt_id"];
        $model = new AboutModel;
        $phtfind = $model->getOnepht($id);
        $phtOldName = $phtfind["abt_photo"];
        $errors= [];
        if(isset($_FILES["abt_photo"])&& !empty($_FILES["abt_photo"]["name"]) && !empty($_FILES["abt_photo"]["tmp_name"]))
        {
            $imgInfo = getimagesize($_FILES["abt_photo"]["tmp_name"]);
            switch($imgInfo)
            {
                case $imgInfo === "false" || false:
                    $errors["update_photo"] = "Attention, ce fichier n'est pas une photo.";
                    break;
                case $imgInfo["0"] !== "500":
                    $errors["update_photo"] = "Veuillez téléverser une photo à la largeur de 500 pixels.";
                    break;
                case $imgInfo["mime"] !== "image/jpeg":
                    $errors["update_photo"] = "Veuillez téléverser une photo au format .jpeg ou .jpg.";
                    break;
                default:
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
            }
        }
        else
        {
            $errors["update_photo"] = "Veuillez selectionner une photo avant de valider la modification.";
        }
        if(!empty($_POST))
        switch($_POST)
        {
            case(isset($_POST["abt_content"])):
                if(!empty($_POST["abt_content"]))
                {
                    $column = "abt_content";
                    $data = [
                        "newData"=>$_POST["abt_content"],
                        "id"=>$id
                    ];
                    $model->addAboutcontent($column,$data);
                }
                else
                {
                    $errors["update_content"] = "Veuillez renseigner la présentation avant de valider la modification.";
                }
                break;
            case(isset($_POST["abt_facebook"])):
                if(!empty($_POST["abt_facebook"]))
                {
                    $column = "abt_facebook";
                    $data = [
                        "newData"=>$_POST["abt_facebook"],
                        "id"=>$id
                    ];
                    $model->addAboutcontent($column,$data);
                }
                else
                {
                    $errors["update_facebook"] = "Veuillez renseigner le lien facebook avant de valider la modification.";
                }
                break;
            case(isset($_POST["abt_instagram"])):
                if(!empty($_POST["abt_instagram"]))
                {
                    $column = "abt_instagram";
                    $data = [
                        "newData"=>$_POST["abt_instagram"],
                        "id"=>$id
                    ];
                    $model->addAboutcontent($column,$data);
                }
                else
                {
                    $errors["update_instagram"] = "Veuillez renseigner le lien instagram avant de valider la modification.";
                }
                break;
            case(isset($_POST["abt_twitter"])):
                if(!empty($_POST["abt_twitter"]))
                {
                    $column = "abt_twitter";
                    $data = [
                        "newData"=>$_POST["abt_twitter"],
                        "id"=>$id
                    ];
                    $model->addAboutcontent($column,$data);
                }
                else
                {
                    $errors["update_twitter"] = "Veuillez renseigner le lien twitter avant de valider la modification.";
                }
                break;
        }
        if(isset($errors)&& !empty($errors))
        {
            $about = $model->getOneContent();
            $this->render("about",["about"=>$about,"errors"=>$errors]);
        }
        else
        {
            header("location:about");
        }
    }

    public function updateCategorie():void
    {
        $catModel = new CategoriesModel;
        if(isset($_POST["cat_name"])&&!empty($_POST["cat_name"]))
        {
            $data = [
                "cat_name"=>$_POST["cat_name"],
                "id"=>$_GET["cat_id"]
            ];
            
            $catModel->updateCatName($data);
            header("location:albums");
        }
        else
        {
            $categories = $catModel->getCategories();
            $albmCatContents = $catModel->catAndAlbmJoin();

            $error["update_categories"] = "Veuillez définir un nom à la catégorie avant de valider la modification.";
            $this->render("albums",["categories"=>$categories,"contents"=>$albmCatContents,"error"=>$error]);
        }
    }

    public function updateAlbum():void
    {
        $model = new AlbumsModel;
        $catModel= new CategoriesModel;
        $albmCatContents = $catModel->catAndAlbmJoin();
        $categories = $catModel->getCategories();
        $errors = [];
        $id = $_GET["albm_id"];
        if(isset($_POST["categories"]) && !empty($_POST["categories"]) &&
            isset($_POST["albm_title"]) && !empty($_POST["albm_title"]) &&
            isset($_POST["albm_description"]) && !empty($_POST["albm_description"]))
        {
            $oldPhotoRequest = $model->getPhtAlbm($id);
            $oldPhoto = $oldPhotoRequest["albm_photo"];
            if(isset($_FILES["albm_pht"]) && !empty($_FILES["albm_pht"]["name"]))
            {
                $imgInfo = getimagesize($_FILES["albm_pht"]["tmp_name"]);
                switch($imgInfo)
                {
                    case $imgInfo === "false" || false:
                        $errors["update_image_errors"]="Attention, ce fichier n'est pas une photo.";
                        break;
                    case $imgInfo["mime"] !== "image/jpeg":
                        $errors["update_image_errors"]="Veuillez téléverser une image au format .jpeg ou .jpg.";
                        break;
                    case $imgInfo["3"] !== 'width="250" height="250"':
                        $errors["update_image_errors"]="Veuillez téléverser une image au format 250x250 pixels.";
                        break;
                    default:
                        $phtNewName = $_FILES["albm_pht"]["name"];
                        $tmpName = $_FILES["albm_pht"]["tmp_name"];
                        $dir = "../assets/img/albm_photos/";
                        unlink($dir.$oldPhoto);
                        move_uploaded_file($tmpName, $dir . $phtNewName);
                        $data = [
                            "cat_id"=>$_POST["categories"],
                            "title"=>$_POST["albm_title"],
                            "descrip"=>$_POST["albm_description"],
                            "photo"=>$phtNewName,
                            "id"=>$id
                        ];
                        $model->updateAlbum($data);
                        header("location:albums");
                }
                if(isset($errors)&&!empty($errors))
                {
                    $this->render("albums",[
                        "contents"=>$albmCatContents,
                        "categories"=>$categories,
                        "errors"=>$errors,
                        "id"=>$id]);
                }
            }
            else
            {
                $data = [
                    "cat_id"=>$_POST["categories"],
                    "title"=>$_POST["albm_title"],
                    "descrip"=>$_POST["albm_description"],
                    "photo"=>$oldPhoto,
                    "id"=>$id
                ];
                $model->updateAlbum($data);
                header("location:albums");
            }
        }
        else
        {
            $errors["update_empty"]="Veuillez renseigner tous les champs avant de valider le formulaire.";
            $this->render("albums",[
                "contents"=>$albmCatContents,
            "categories"=>$categories,
            "errors"=>$errors,
            "id"=>$id]);
        }
    }
}