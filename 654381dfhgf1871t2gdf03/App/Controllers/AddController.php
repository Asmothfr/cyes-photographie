<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\ActualitiesModel;
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
        $cat = $catModel->getCategories();
        $albmCatContents = $catModel->catAndAlbmJoin();

        if(!isset($_POST["catName"])||empty($_POST["catName"]))
        {
            $error["catError"] = "Veillez nommer la catégorie";
        }
        if(isset($error)&&!empty($error))
        {
            $this->render("albums", ["contents"=>$albmCatContents, "categories"=>$cat, "error"=>$error]);
        }
        else
        {
            $data = ["catName"=>$_POST["catName"]];
            $catModel->addOneCategorie($data);
            header("location: albums");
        }
    }
    /*
        Ajoute un album et crée un dossier dans 
        assets/img/photos du nom de l'id du dernier album ajouter en base de donnée
    */
    public function addOneAlbum()
    {
        $errors = [];
        $catModel = new CategoriesModel;
        $albModel = new AlbumsModel;
        $albmCatContents = $catModel->catAndAlbmJoin();
        $cat = $catModel->getCategories();
        
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
        if(!isset($_FILES["photoName"]) || empty($_FILES["photoName"]["name"]) && empty($_FILES["photoName"]["tmp_name"]))
        {
            $errors["e4"] = "Veuillez selectionner une photo de présentation pour l'album.";
        }
        else
        {
            $info_img = getimagesize($_FILES["photoName"]["tmp_name"]);
            switch($info_img)
            {
                case $info_img === "false" || false:
                    $errors["e5"] = "C'est pas gentil de vouloir envoyer des photos qui n'en sont pas. Faut pas refaire ça !";
                    break;
                case $info_img["mime"] != "image/jpeg":
                    $errors["e5"] = "Veuillez selectionner une photo au format .jpg ou .jpeg";
                    break;
                case $info_img["3"] != 'width="250" height="250"':
                    $errors["e5"] = "Veuillez téléverser une image au format 250x250 pixels.";
                    break;
            }
        }
        if(isset($errors) && !empty($errors))
        {
            $this->render("albums", ["contents"=>$albmCatContents, "categories"=>$cat, "errors"=>$errors]);
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
            mkdir("../assets/img/thumbnails/".$lastAlbum["MAX(albm_id)"]);
            
            header("location: albums");
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
        {   $validPhotos = [];
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
                //Récupération des noms des photos valides.
            $phtNames = array_intersect_key($uploadedPhotos["name"], $tmpNames);

            $originalDestination = "../assets/img/photos/$albmId/";
            $thumbnailDestination ="../assets/img/thumbnails/$albmId/";
            $data["albm_id"] = $albmId;
            /***Création des images avec largeur et hauteur modifiées.
                Envoie dans les dossier les images originales et modifiées.
                Envoie en base de donnée le nom des images.
            ***/
            foreach($tmpNames as $key => $tmpName)
            {   
                $maxWidth = 500;
                $maxHeight = 751;
                list($widthOrigin, $heightOrigin) = getimagesize($tmpName);
                $ratio = $widthOrigin/$heightOrigin;
                
                if($maxWidth/$maxHeight > $ratio)
                {
                    $maxWidth = $maxHeight*$ratio;
                }
                else
                {
                    $maxHeight = $maxWidth/$ratio;
                }

                $createImage = imagecreatetruecolor($maxWidth,$maxHeight);
                $originImg = imagecreatefromjpeg($tmpName);

                imagecopyresampled($createImage,$originImg,0,0,0,0,$maxWidth,$maxHeight,$widthOrigin,$heightOrigin);
                imagejpeg($createImage, $thumbnailDestination.$phtNames[$key], 100);
                move_uploaded_file($tmpName,$originalDestination . $phtNames[$key]);
                $data["phtName"] = $phtNames[$key]; 
                $photosModel->addPhotos($data);
                header("location: album_".$albmId);
            }
        }
        else
        {
            $errors["e1"] = "Veuillez selectionner des photos avant de valider le formulaire."; 
            $this->render("photos",["album"=>$album, "photos"=>$photos, "errors"=>$errors]);
        }
    }
    /*
        Vérification individuelle de plusieurs formulaire, afin de ne remplir 
        que la colonne choisis en base de donnée.
    */
    public function addAboutcontent()
    {
        $model = new AboutModel;
        $abtInfo = $model->getOneContent();
        $id = $abtInfo["abt_id"];
        $errors = [];

        if(isset($_FILES["abtPhoto"]["name"]) && !empty($_FILES["abtPhoto"]["name"]))
        {
            $imgInfo = getimagesize($_FILES["abtPhoto"]["tmp_name"]);
            switch($imgInfo)
            {
                case $imgInfo === "false" || false:
                    $errors["photo"] = "Attention, ce fichier n'est pas une photo.";
                    break;
                case $imgInfo["mime"] !== "image/jpeg":
                    $errors["photo"] = "Veuillez téléverser une image au format .jpeg ou .jpg.";
                    break;
                case $imgInfo["0"] != 500:
                    $errors["photo"] = "Veuillez téléverser une image d'une largeur de 500px";
                    break;
                default:
                    $phtName = $_FILES["abtPhoto"]["name"];
                    $phtTmpName = $_FILES["abtPhoto"]["tmp_name"];
                    $column = "abt_photo";
                    $dir = "../assets/img/about_img/";
                    move_uploaded_file($phtTmpName, $dir . $phtName);
                    $data = [
                        "newData" => $phtName,
                        "id" => $id
                    ];
                    $model->addAboutcontent($column,$data);
                    header("location: about");
            }
        }
        else
        {
            $errors["photo"] = "Veuillez selectionner une photo de présentation.";
        }
        switch($_POST)
        {
            case isset($_POST["abt_content"]) :
                if(!empty($_POST["abt_content"]))
                {
                    $column = "abt_content";
                    $data = [
                        "newData" => $_POST["abt_content"],
                        "id" => $id
                    ];
                    $model->addAboutcontent($column,$data);
                    header("location: about");
                }
                else
                {
                    $errors["content"] = "Veuillez renseigner la description";
                }
                break;
            case isset($_POST["abt_facebook"]):
                if(!empty($_POST["abt_facebook"]))
                {
                    $column = "abt_facebook";
                    $data = [
                        "newData" => $_POST["abt_facebook"],
                        "id" => $id
                    ];
                    $model->addAboutcontent($column,$data);
                    header("location: about");
                }
                else
                {
                    $errors["facebook"] = "Veuillez renseigner le lien facebook.";
                }
                break;
            case isset($_POST["abt_instagram"]):
                if(!empty($_POST["abt_instagram"]))
                {
                    $column = "abt_instagram";
                    $data = [
                        "newData" => $_POST["abt_instagram"],
                        "id" => $id
                    ];
                    $model->addAboutcontent($column,$data);
                    header("location: about");
                }
                else
                {
                    $errors["instagram"] = "Veuillez renseigner le lien instagram.";
                }
                break;
            case isset($_POST["abt_twitter"]):
                if(!empty($_POST["abt_twitter"]))
                {
                    $column = "abt_twitter";
                    $data = [
                        "newData" => $_POST["abt_twitter"],
                        "id" => $id
                    ];
                    $model->addAboutcontent($column,$data);
                    header("location: about");
                }
                else
                {
                    $errors["twitter"] = "Veuillez renseigner le lien twitter.";
                }
                break;
        }
        if(isset($errors) && !empty($errors))
        {
            $this->render("about",["about"=>$abtInfo,"errors"=>$errors]);
        }
    }

    public function addActualities()
    {
        $errors = [];
        $model = new ActualitiesModel;
        $contents = $model->getActuContent();
       
        if(!isset($_FILES["act_photo"]) || empty($_FILES["act_photo"]["name"]) && empty($_FILES["act_photo"]["tmp_name"]))
        {
            $errors["photo"] = "Veuillez selectionner une photo.";
        }
        else
        {
            $imgInfo = getimagesize($_FILES["act_photo"]["tmp_name"]);
            switch($imgInfo)
            {
                case $imgInfo === "false" || false:
                    $errors["photo"] = "LE FICHIER ENVOYÉ N'EST PAS UNE PHOTO.";
                    break;
                case $imgInfo["mime"] != "image/jpeg":
                    $errors["photo"] = "Veuillez téléverser une photo au format .jpg ou .jpeg.";
                    break;
                case $imgInfo["3"] != 'width="250" height="250"':
                    $errors["photo"] = "Veuillez téléverser une photo au format 250x250 pixels";
                    break;
            }
        }
        if(!isset($_POST["act_title"]) || empty($_POST["act_title"]))
        {
            $errors["title"] = "Veuillez nommer l'article.";
        }
        if(!isset($_POST["act_date"]) || empty($_POST["act_date"]))
        {
            $errors["date"] = "Veuillez choisir une date.";
        }
        if(!isset($_POST["act_content"]) || empty($_POST["act_content"]))
        {
            $errors["text"] = "Veuillez renseigner une description.";
        }
        if(isset($errors) && !empty($errors))
        {
            $this->render("actualities",["contents"=>$contents,"errors"=>$errors]);
        }
        else
        {
            $dir = "../assets/img/actu_img/";
            $phtName = $_FILES["act_photo"]["name"];
            $tmpName = $_FILES["act_photo"]["tmp_name"];
            move_uploaded_file($tmpName, $dir . $phtName);
            $data = [
                $_POST["act_title"],
                $_POST["act_content"],
                $_POST["act_date"],
                $_FILES["act_photo"]["name"]
            ];
            $model->addActualitie($data);
            header("location:actualities");
        }
    }
}