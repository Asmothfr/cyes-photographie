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
    public function addOneCategorie(array $data):void
    {
        $sqlQuery = "INSERT INTO categories(cat_name) VALUES (:catName)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function updateCatName(array $data):void
    {
        $sqlQuery = "UPDATE categories SET cat_name =:cat_name WHERE cat_id=:id";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function deleteOneCategorie(string $id):void
    {
        $sqlQuery = "DELETE FROM categories WHERE cat_id = ?";
        $this->processOneTableRow($sqlQuery, [$id]);
    }
}