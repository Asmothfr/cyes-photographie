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
}