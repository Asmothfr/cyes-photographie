<?php

namespace App\Models;

use Library\Database;

class PhotosModel extends Database
{
    public function getPhotos()
    {
        $sqlQuery = "SELECT * FROM photos";
        return $this->findAll($sqlQuery);
    }

    public function getAllPhotos($id)
    {
        $sqlQuery = "SELECT * 
                    FROM photos
                    WHERE pht_albm_id = ?";
        return $this->findAll( $sqlQuery, [$id]);
    }
}