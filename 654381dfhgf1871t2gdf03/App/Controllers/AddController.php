<?php

namespace App\Controllers;

use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use App\Models\PhotosModel;
use Library\LayoutController;

class AddController extends LayoutController
{
    public function addOneCategorie()
    {
        $error=[];
        $catModel = new CategoriesModel;
        $albModel = new AlbumsModel;
        $cat = $catModel->getCategories();
        $albums = $albModel->getAlbums();

        if(!isset($_POST["catName"])||empty($_POST["catName"]))
        {
            $error["catError"] = "Veillez nommer la catégorie";
        }
        if(isset($error)&&!empty($error))
        {
            $this->render("albums", ["albums"=>$albums, "categories"=>$cat, "error"=>$error]);
        }
        else
        {
            $data = ["catName"=>$_POST["catName"]];
            $catModel->addOneCategorie($data);
            header("location: index.php?route=albums");
        }
    }
    public function addOneAlbum()
    {
        $errors = [];
        $catModel = new CategoriesModel;
        $albModel = new AlbumsModel;
        $cat = $catModel->getCategories();
        $albums = $albModel->getAlbums();
        
        if(!isset($_POST["categories"]) || empty($_POST["categories"]))
        {
            $errors["e1"] = "Veuillez choisir une categorie.";
        }
        if(!isset($_POST["title"]) || empty($_POST["title"]))
        {
            $errors["e2"] = "Veuillez renseigner un titre.";
        }
        if(!isset($_POST["description"]) || empty($_POST["description"]))
        {
            $errors["e3"] = "Veuillez donner une description à l'album.";
        }
        if(!isset($_FILES["photoName"]) || empty($_FILES["photoName"]) || $_FILES["photoName"]["type"] != "image/jpeg")
        {
            $errors["e4"] = "Veuillez selectionner une photo au format .jpg ou .jpeg";
        }
        if(isset($errors) && !empty($errors))
        {
            $this->render("albums", ["albums"=>$albums, "categories"=>$cat, "errors"=>$errors]);
        }
        else
        {
            if(mime_content_type($_FILES["photoName"]["tmp_name"]) != "image/jpeg")
            {
                $errors["e5"] = "C'est pas gentil de vouloir envoyer des photos qui n'en sont pas. Faut pas refaire ça !";
                $this->render("albums", ["albums"=>$albums, "categories"=>$cat, "errors"=>$errors]);
            }
            else
            {
                echo("<pre>");
                var_dump($_FILES);
                echo("</pre>");
                die;
                $origine = $_FILES["photoName"]["tmp_name"];
                $destination = "../assets/img/albm_photos/".$_FILES["photoName"]["name"];
                $data = [
                    "categories"=>$_POST["categories"],
                    "title"=>$_POST["title"],
                    "descript"=>$_POST["description"],
                    "photoName"=>$_FILES["photoName"]["name"],
                ];
                
                $albModel->addOneAlbum($data);
                $lastAlbum = $albModel->getLastAlbum();
                
                move_uploaded_file($origine,$destination);
                mkdir("../assets/img/photos/".$lastAlbum["MAX(albm_id)"]);
                
                header("location: index.php?route=albums");
            }
            die;
        }
    }

    public function addPhotos()
    {
        $errors = [];
        if(!isset($_POST["albm_id"]) || empty($_POST["albm_id"]))
        {
            $errors["critical"] = "Une erreur est survenue lors de l'attribution automatique de l'id de l'album. Veuillez contacter votre admin pour résoudre ce problème !";
            $this->render("photos",["critical"=>$errors]);
            echo("CRITICAL");
        }
        else
        {
            $photosModel = new PhotosModel;
            $albumsModel = new AlbumsModel;
            $albmId = $_POST["albm_id"];
            $album = $albumsModel->getOneAlbum($albmId);
            $photos = $photosModel->getAllPhotos($albmId);
            echo("<pre>");
            echo("TABLEAU 1");
            echo("<br>");
            var_dump($_FILES["photos"]);
            echo("</pre>");
            $errors = [];
            if(!isset($_FILES["photos"]) || empty($_FILES["photos"]) || ($_FILES["photos"]["type"]) != "image/jpeg")
            {
                echo("CONDITION FAILED");
                $errors["e1"] = "Veuillez selectionner une ou plusieurs photo au format .jpg ou .jpeg";
            }
            if(isset($errors) && !empty($errors))
            {
                $this->render("photos",["album"=>$album, "photos"=>$photos]);
            }
            else
            {
                header("location: index.php?route=gallery&id=" . $albmId);
            }

        }
            
    }
}