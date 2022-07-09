<?php

namespace App\Controllers;

use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use Library\LayoutController;

class AddController extends LayoutController
{
    public function addOneCategorie()
    {
        $error=[];
        if(!isset($_POST["catName"])||empty($_POST["catName"]))
        {
            $error["catError"] = "Veillez nommer la catégorie";
        }
        if(isset($error)&&!empty($error))
        {
            $catModel = new CategoriesModel;
            $cat = $catModel->getCategories();

            $albModel = new AlbumsModel;
            $albums = $albModel->getAlbums();
            $this->render("albums", ["albums"=>$albums, "categories"=>$cat, "error"=>$error]);
        }
        else
        {
            $data = ["catName"=>$_POST["catName"]];

            $catModel = new CategoriesModel;
            $albModel = new AlbumsModel;

            //Envoyer la photo dans le dossier.

            $catModel->addOneCategorie($data);

            $cat = $catModel->getCategories();
            $albums = $albModel->getAlbums();
            $this->render("albums",["categories"=>$catModel,"albums"=>$albModel]);

        }
    }
    public function addOneAlbum()
    {
        $errors = [];
        
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
            $errors["e3"] = "Veuillez renseigner une categorie.";
        }
        // if(!isset($_POST["photoName"]) || empty($_POST["photoName"]))
        // {
        //     $errors["e4"] = "Veuillez choisir un fichier au format .jpeg.";
        // }
        var_dump($_POST["photoName"]);
        if(isset($errors) && !empty($errors))
        {
            $catModel = new CategoriesModel;
            $cat = $catModel->getCategories();
            $albModel = new AlbumsModel;
            $albums = $albModel->getAlbums();
            $this->render("albums", ["albums"=>$albums, "categories"=>$cat, "errors"=>$errors]);

        }
        else
        {
            $data = [
                "categories"=>$_POST["categories"],
                "title"=>$_POST["title"],
                "descript"=>$_POST["description"],
                "photoName"=>$_POST["photoName"],
            ];
            
            $catModel = new CategoriesModel;
            $cat = $catModel->getCategories();
            $albModel = new AlbumsModel;
            $albModel->addOneAlbum($data);
            $albums = $albModel->getAlbums();
            $this->render("albums",["categories"=>$catModel,"albums"=>$albModel]);
        }
    }
}