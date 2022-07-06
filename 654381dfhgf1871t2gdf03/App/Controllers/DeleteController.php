<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\ContactModel;
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
        
        $phtId = $_GET["pht_id"];
        $albmId = $_GET["albm_id"];
        $model = new PhotosModel;
        $model->deleteOnePhoto($phtId);
        unlink( $filename );
        header("location: index.php?route=gallery&id=".$albmId);
    }
}



