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

    public function getAllPhotos(string $id): array
    {
        $sqlQuery = "SELECT * 
                    FROM photos
                    WHERE pht_albm_id = ?";
        return $this->findAll( $sqlQuery, [$id]);
    }

    public function addPhotos(array $data):void
    {
        $sqlQuery = "INSERT INTO photos(pht_albm_id,pht_name) VALUES(:albm_id,:phtName)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function deleteOnePhoto( string $phtName):void
    {
        $sqlQuery = "DELETE FROM photos WHERE pht_name = ?";
        $this->processOneTableRow($sqlQuery, [$phtName]);
    }

    public function deleteAllphotos(string $id):void
    {
        $sqlQuery = "DELETE FROM photos WHERE pht_albm_id = ?";
        $this->processOneTableRow($sqlQuery, [$id]);
    }
}