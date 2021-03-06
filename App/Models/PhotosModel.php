<?php

namespace App\Models;

use Database\Database;

class PhotosModel extends Database
{
    public function getPhotos(): array
    {
        $sqlQuery = "SELECT * FROM photos";
        return $this->findAll($sqlQuery);
    }

    public function getAllPhotos($id): array
    {
        $sqlQuery = "SELECT * 
                    FROM photos
                    WHERE pht_albm_id = ?";
        return $this->findAll( $sqlQuery, [$id]);
    }
}