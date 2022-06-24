<?php

namespace App\Models;

use Library\Database;

class GalleriesModel extends Database
{
    public function getAlbums()
    {
        $sqlQuery = "SELECT * FROM albums";
        return $this->findAll( $sqlQuery);
    }
}