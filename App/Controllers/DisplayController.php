<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\PhotosModel;
use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\AlbumsModel;

// Classe uniquement dédié à l'affichage des pages du sites.
// Chaque méthode est construite avec l'appel de la donnée par l'instantiation des modèles (voir liste ci-dessus);
// Et l'affichage est gérer par la méthode render (voir LayoutController.php dans Library).
class DisplayController extends LayoutController
{
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
        $secondModel = new PhotosModel;
        $album = $model->getOneAlbum($id);
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