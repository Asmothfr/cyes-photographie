<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\PhotosModel;
use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\AlbumsModel;

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
        $albmModel = new AlbumsModel;
        $albums = $albmModel->getAlbums();
        $this->render("albums", ["albums"=>$albums]);
    }

    public function displayGallery(): void
    {   
        $id= $_GET["id"];

        $model = new AlbumsModel;
        $album = $model->getOneAlbum($id);

        $secondModel = new PhotosModel;
        $photos = $secondModel->getAllPhotos($id);

        $this->render("gallery", ["album"=>$album, "photos"=>$photos]);
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
}