<?php

namespace App\Models;

use Database\Database;

class CategoriesModel extends Database
{
    public function getCategories():array
    {
        $sqlQuery = "SELECT * FROM categories";
        return $this->findAll($sqlQuery);
    }
}