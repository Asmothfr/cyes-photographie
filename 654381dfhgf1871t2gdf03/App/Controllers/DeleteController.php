<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\ContactModel;
use App\Models\AlbumsModel;
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
        function delTree($albmDir) {
            $files = array_diff(scandir($albmDir), array('.','..'));
             foreach ($files as $file) {
               (is_dir("$albmDir/$file")) ? delTree("$albmDir/$file") : unlink("$albmDir/$file");
             }
             return rmdir($albmDir);
        }

        $albmId = $_GET["albm_id"];
        $albmPthName = $_GET["albm_photo"];
        $albmDir = "../assets/img/photos/".$albmId;

        $model = new AlbumsModel;
        $model->deleteOneAlbum($albmId);

        delTree($albmDir);
        unlink("../assets/img/albm_photos/$albmPthName");
        header("location: index.php?route=albums");
    }
}



