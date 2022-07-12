<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\ContactModel;
use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use App\Models\PhotosModel;

class DeleteController extends LayoutController
{
    public function deleteOneMail()
    {
        $id = $_GET["id"];
        $model = new ContactModel;
        $model->deleteOneMail($id);
        header("location: index.php?route=mails");
    }

    public function deleteOnePhoto()
    {
        
        $phtName = $_GET["pht_name"];
        $albmId = $_GET["albm_id"];
        $model = new PhotosModel;
        $model->deleteOnePhoto($phtName);

        unlink("../assets/img/photos/$albmId/$phtName");
        
        header("location: index.php?route=gallery&id=".$albmId);
    }

    public function deleteOneAlbum()
    {
        $albmId = $_GET["albm_id"];
        $albmPthName = $_GET["albm_photo"];
        $albmDir = "../assets/img/photos/".$albmId;
        $model = new AlbumsModel;

        $this->delTree($albmDir);
        $model->deleteOneAlbum($albmId);

        unlink("../assets/img/albm_photos/$albmPthName");
        header("location: index.php?route=albums");
    }

    public function deleteOneCategorie()
    {
        $catId = $_GET["cat_id"];
        $albmModel = new AlbumsModel;
        $catModel = new CategoriesModel;
        $albumsList = $albmModel->getAlbumsbyId($catId);

        foreach($albumsList as $album)
        {
            $albmId = $album["albm_id"];
            $albmPthName = $album["albm_photo"];
            $albmDir = "../assets/img/photos/".$albmId;

            $this->delTree($albmDir);
            $albmModel->deleteOneAlbum($album["albm_id"]);
            unlink("../assets/img/albm_photos/".$albmPthName);
        }

        $catModel->deleteOneCategorie($catId);
        header("location: index.php?route=albums");
    }
    
    public function delTree($dir)
        {
            $files = array_diff(scandir($dir), array('.','..'));
            foreach ($files as $file) {
              (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
}



