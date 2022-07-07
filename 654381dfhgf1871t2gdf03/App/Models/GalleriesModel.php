<?php

namespace App\Models;

use Database\Database;

class GalleriesModel extends Database
{
    public function getAlbums()
    {
        $sqlQuery = "SELECT * FROM albums";
        return $this->findAll( $sqlQuery);
    }

    public function getOneAlbum($id)
    {
        $sqlQuery = "SELECT * 
                    FROM albums
                    WHERE albm_id = ?";
        return $this->find( $sqlQuery, [$id]);
    }

    public function deleteOneAlbum($albmId)
    {
        $sqlQuery = "DELETE FROM albums WHERE albm_id = ?";
        return $this->processOneTableRow($sqlQuery, [$albmId]);
    }
}