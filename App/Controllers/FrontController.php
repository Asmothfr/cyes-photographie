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
    {   $id= $_GET["id"];
        $model = new GalleriesModel;
        $album = $model->getOneAlbum($id);
        $photos = $model->getAllPhotos($id);
        echo("<pre>");
        print_r($album);
        echo("</pre>");
        echo("<pre>");
        print_r($photos);
        echo("</pre>");
        $this->render("photos", ["album"=>$album, "photos"=>$photos]);
    }
}