<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\GalleriesModel;
use App\Models\PhotosModel;
use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\TestModel;

class DisplayController extends LayoutController
{
    public function display404(): void
    {
        require_once "App/views/_404.phtml";
    }

    public function displayHome(): void
    {
        $this->render("home");
    }

    public function displayAlbums(): void
    {
        $model = new GalleriesModel;
        $albums = $model->getAlbums();
        $this->render("galleries", ["albums"=>$albums]);
    }

    public function displayPhotos(): void
    {   
        $id= $_GET["id"];

        $model = new GalleriesModel;
        $album = $model->getOneAlbum($id);

        $secondModel = new PhotosModel;
        $photos = $secondModel->getAllPhotos($id);

        $this->render("photos", ["album"=>$album, "photos"=>$photos]);
    }

    public function displayAbout(): void
    {
        $model = new AboutModel;
        $about = $model->getOneContent();
        $this->render("about", ["about"=>$about]);
    }

    public function displayActualities():void
    {
        $model = new ActualitiesModel;
        $actu = $model->getActuContent();
        $this->render("actualities", ["contents"=>$actu]);
    }

    public function displayContact():void
    {
        $this->render("contact");
    }

    public function displayTestForm():void
    {
        if( isset($_POST["test1"]) && !empty($_POST["test1"]) &&
            isset($_POST["test2"]) && !empty($_POST["test2"]))
        {
            print_r($_POST);
            $data = [
                "d1"=>$_POST["test1"],
                "d2"=>$_POST["test2"],
            ];
            $model = new TestModel();
            $model->contactFormValidation($data["d1"],$data["d2"],);
        }
        $this->render("test_formulaire");
    }
}