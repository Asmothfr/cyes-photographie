<?php

namespace App\Controllers;

use App\Models\GalleriesModel;
use App\Models\PhotosModel;
use Library\LayoutController;
use Models\PhotosModel as ModelsPhotosModel;

class FrontController extends LayoutController
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
        $model = new PhotosModel;
        $photos = $model->getPhotos();
        $this->render("photos", ["photos"=>$photos]);
    }
}