<?php

namespace App\Models;

use Database\Database;

class AlbumsModel extends Database
{
    public function getAlbums()
    {
        $sqlQuery = "SELECT * FROM albums";
        return $this->findAll($sqlQuery);
    }

    public function getOneAlbum($id)
    {
        $sqlQuery = "SELECT * 
                    FROM albums
                    WHERE albm_id = ?";
        return $this->find($sqlQuery, [$id]);
    }

    public function addOneAlbum($data)
    {
        $sqlQuery = "INSERT INTO albums (albm_cat_id,albm_title,albm_description,albm_photo) VALUES (:categories,:title,:descript,:photoName)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function deleteOneAlbum($albmId)
    {
        $sqlQuery = "DELETE FROM albums WHERE albm_id = ?";
        return $this->processOneTableRow($sqlQuery, [$albmId]);
    }
}