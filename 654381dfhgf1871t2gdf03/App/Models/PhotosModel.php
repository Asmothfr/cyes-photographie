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

    public function addPhotos($data)
    {
        $sqlQuery = "INSERT INTO photos(pht_albm_id,pht_name) VALUES(:albm_id,:phtName)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function deleteOnePhoto($phtName):mixed
    {
        $sqlQuery = "DELETE FROM photos WHERE pht_name = ?";
        return $this->processOneTableRow($sqlQuery, [$phtName]);
    }
}