<?php

namespace App\Models;

use Database\Database;

class AboutModel extends Database
{
    public function getOneContent(): mixed
    {
        $sqlQuery = "SELECT * FROM abouts";
        return $this->find($sqlQuery);
    }

    public function addAboutcontent($column,$data,$id):void
    {
        $sqlQuery = "UPDATE abouts SET $column = '$data' WHERE abt_id = ?";
        $this->addOnecolumn($sqlQuery,[$id]);
    }

    public function deleteAboutContent($column):void
    {
        $sqlQuery = "UPDATE abouts SET $column = NULL ";
        $this->deleteOneColumn($sqlQuery);
    }
}