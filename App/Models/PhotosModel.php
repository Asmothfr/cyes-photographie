<?php

namespace App\Models;

use Database\Database;

class PhotosModel extends Database
{
    public function getAllPhotos($id): array
    {
        $sqlQuery = "SELECT * 
                    FROM photos
                    WHERE pht_albm_id = ?";
        return $this->findAll( $sqlQuery, [$id]);
    }
}