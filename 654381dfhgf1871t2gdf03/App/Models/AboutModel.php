<?php

namespace App\Models;

use Database\Database;

class AboutModel extends Database
{
    public function getOneContent(): array
    {
        $sqlQuery = "SELECT * FROM abouts";
        return $this->find($sqlQuery);
    }

    public function getOnepht(string $id):array
    {
        $sqlQuery = "SELECT abt_photo FROM abouts WHERE abt_id = ?";
        return $this->find($sqlQuery,[$id]);
    }
    public function addAboutcontent(string $column, array $data):void
    {
        $sqlQuery = "UPDATE abouts SET $column = :newData WHERE abt_id = :id";
        $this->processOneTableRow($sqlQuery,$data);
    }

    public function deleteAboutContent(string $column, array $data):void
    {
        $sqlQuery = "UPDATE abouts SET $column = :newData";
        $this->processOneTableRow($sqlQuery,$data);
    }
}