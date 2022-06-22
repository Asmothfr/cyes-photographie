<?php

namespace App\Models;

use Library\Database;

class TestModel extends Database
{
    public function getPhotosList(): array
    {
        $sqlQuery = "SELECT * from photos";
        return $this->findAll($sqlQuery);
    }
}