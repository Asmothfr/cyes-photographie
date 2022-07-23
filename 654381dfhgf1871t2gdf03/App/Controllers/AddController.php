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
        }
    }

    public function addPhotos()
    {
        $errors = [];
        $albmId = $_GET["albm_id"];
        $photosModel = new PhotosModel;
        $albumsModel = new AlbumsModel;
        $album = $albumsModel->getOneAlbum($albmId);
        $photos = $photosModel->getAllPhotos($albmId);
        
        if(($_FILES["photos"]) && in_array(!empty([""]),$_FILES["photos"]["name"]) && in_array(!empty([""]),$_FILES["photos"]["tmp_name"]))
        {
            $validPhotos = [];
            $refusedPhotos = [];
            $uploadedPhotos = $_FILES["photos"];

            foreach($uploadedPhotos["tmp_name"] as $uploadedPhoto)
            {
                if(mime_content_type($uploadedPhoto) != "image/jpeg")
                {
                    array_push($refusedPhotos, $uploadedPhoto);
                }
                else
                {
                    array_push($validPhotos, $uploadedPhoto);
                }
            }  
            
            //Comparaison entre les photos envoyés et les photos valides.
            //Récupération des index des photos valides.
            $tmpNames = array_intersect($uploadedPhotos["tmp_name"], $validPhotos);
            $phtNames = $uploadedPhotos["name"];
            $destination = "../assets/img/photos/$albmId/";
            $data["albm_id"] = $albmId;

            foreach($tmpNames as $key => $TmpName)
            {
                if(!in_array($phtNames[$key],scandir($destination)))
                {
                    move_uploaded_file($TmpName,$destination . $phtNames[$key]);
                    $data["phtName"] = $phtNames[$key];
                    $photosModel->addPhotos($data);
                    print_r($phtNames[$key]);
                }
            }
                header("location: index.php?route=gallery&id=".$albmId);
        }
        else
        {
            $errors["e1"] = "Veuillez selectionner des photos avant de valider le formulaire."; 
            $this->render("photos",["album"=>$album, "photos"=>$photos, "errors"=>$errors]);
        }
        
    }
}