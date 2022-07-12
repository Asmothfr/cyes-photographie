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
    public function addOneCategorie($data)
    {
        $sqlQuery = "INSERT INTO categories(cat_name) VALUES (:catName)";
        return $this->processOneTableRow($sqlQuery, $data);
    }
    public function deleteOneCategorie($id)
    {
        $sqlQuery = "DELETE FROM categories WHERE cat_id = ?";
        return $this->processOneTableRow($sqlQuery, [$id]);
    }
}