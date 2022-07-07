<?php

namespace App\Controllers;

use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use Library\LayoutController;

class AddController extends LayoutController
{
    public function addOneAlbum()
    {
        $errors = [];
        if(!isset($_POST["categories"])||empty($_POST["categories"]))
        {
            $errors["e1"] = "Veuillez choisir une catégorie";
        }
        if(!isset($_POST["title"])||empty($_POST["title"]))
        {
            $errors["e2"] = "Veuillez définir un titre";
        }
        if(!isset($_POST["description"])||empty($_POST["description"]))
        {
            $errors["e3"] = "Veuillez remplir la description";
        }
        if(!isset($_POST["photoName"])||empty($_POST["photoName"]))
        {
            $errors["e4"] = "Le fichier est incompatible"; 
        }
        else
        {
            // $catData = [
            // ];
            $data = [
                "categories"=>$_POST["categories"],
                "title"=>$_POST["title"],
                "descript"=>$_POST["description"],
                "photoName"=>$_POST["photoName"]
            ];
            $model = new AlbumsModel;
            $model->addOneAlbum($data);

            die;
        }
    }
}