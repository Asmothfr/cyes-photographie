<?php

namespace App\Models;

use Database\Database;

class CategoriesModel extends Database
{
    public function getCategories()
    {
        $sqlQuery = "SELECT * FROM categories";
        return $this->findAll($sqlQuery);
    }
}