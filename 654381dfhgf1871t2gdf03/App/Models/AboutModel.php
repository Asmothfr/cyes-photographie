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

    public function getOnepht($id):array
    {
        $sqlQuery = "SELECT abt_photo FROM abouts WHERE abt_id = ?";
        return $this->find($sqlQuery,[$id]);
    }
    public function addAboutcontent($column,$data):void
    {
        $sqlQuery = "UPDATE abouts SET $column = :newData WHERE abt_id = :id";
        $this->processOneTableRow($sqlQuery,$data);
    }

    public function deleteAboutContent($column,$data):void
    {
        $sqlQuery = "UPDATE abouts SET $column = :newData";
        $this->processOneTableRow($sqlQuery,$data);
    }
}