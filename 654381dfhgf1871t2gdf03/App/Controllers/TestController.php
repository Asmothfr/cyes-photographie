<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\AlbumsModel;
use Library\LayoutController;

class TestController extends LayoutController
{
    public function addFiles()
    {
        $catModel = new CategoriesModel;
        $cat = $catModel->getCategories();
        $albModel = new AlbumsModel;
        $albums = $albModel->getAlbums();
        $this->render("test",["categories"=>$catModel,"albums"=>$albModel]);
    }

    public function validTest()
    {
        $_FILES;
        print_r($_FILES);
        die;
        $catModel = new CategoriesModel;
        $cat = $catModel->getCategories();
        $albModel = new AlbumsModel;
        $albums = $albModel->getAlbums();
        $this->render("test",["categories"=>$catModel,"albums"=>$albModel]);
    }
}