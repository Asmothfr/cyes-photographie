<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\GalleriesModel;
use App\Models\PhotosModel;
use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\ContactModel;

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

    public function displayMails():void
    {
        $model = new ContactModel;
        $mails = $model->getAllMails();
        $this->render("mails",["mails"=>$mails]);
    }

    public function displayOneMail():void
    {
        $id = $_GET["id"];
        $model = new ContactModel;
        $mail = $model->getOneMail($id);
        $this->render("mail", ["mail"=>$mail]);
    }
}