<?php

namespace App\Models;

use Database\Database;

class AlbumsModel extends Database
{
    public function getAlbums():array
    {
        $sqlQuery = "SELECT * FROM albums";
        return $this->findAll($sqlQuery);
    }

    public function getAlbumsbyId(array $id):array
    {
        $sqlQuery = "SELECT * FROM albums WHERE albm_cat_id = ?";
        return $this->findAll($sqlQuery,[$id]);
    }

    public function getOneAlbum(string $id):array
    {
        $sqlQuery = "SELECT * 
                    FROM albums
                    WHERE albm_id = ?";
        return $this->find($sqlQuery, [$id]);
    }

    public function getLastAlbum():array
    {
        $sqlQuery = "SELECT MAX(albm_id) FROM albums";
        return $this->find($sqlQuery);
    }

    public function addOneAlbum(array $data):void
    {
        $sqlQuery = "INSERT INTO albums (albm_cat_id,albm_title,albm_description,albm_photo) VALUES (:categories,:title,:descript,:photoName)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function updateAlbum(array $data):void
    {
        $sqlQuery = "UPDATE albums SET albm_cat_id = :cat_id, albm_title = :title, albm_description = :descrip, albm_photo = :photo WHERE albm_id = :id";
        $this->processOneTableRow($sqlQuery,$data);
    }

    public function deleteOneAlbum(array $albmId):void
    {
        $sqlQuery = "DELETE FROM albums WHERE albm_id = ?";
        $this->processOneTableRow($sqlQuery, [$albmId]);
    }
}