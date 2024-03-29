<?php

namespace App\Models;

use Database\Database;

class ActualitiesModel extends Database
{
    public function getActuContent(): array
    {
        $sqlQuery = "SELECT * FROM actualities";
        return $this->findAll($sqlQuery);
    }

    public function getPhtName(string $id):array
    {
        $sqlQuery = "SELECT act_photo FROM actualities WHERE act_id = ?";
        return $this->find($sqlQuery,[$id]);
    }

    public function addActualitie(array $data):void
    {
        $sqlQuery = "INSERT INTO actualities (act_title, act_content, act_date, act_photo) VALUES (?, ?, ?, ?)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function updateActualitie(array $data):void
    {
        $sqlQuery = "UPDATE actualities 
                        SET act_title = :title, act_content = :content, act_date = :dat, act_photo = :photo WHERE act_id = :id";
        $this->processOneTableRow($sqlQuery,$data);
    }

    public function deleteActualitieById(string $id):void
    {
        $sqlQuery = "DELETE FROM actualities WHERE act_id = ?";
        $this->processOneTableRow($sqlQuery,[$id]);
    }
}