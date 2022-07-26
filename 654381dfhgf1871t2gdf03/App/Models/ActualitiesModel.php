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

    public function getPhtName($id):array
    {
        $sqlQuery = "SELECT act_photo FROM actualities WHERE act_id = ?";
        return $this->find($sqlQuery,[$id]);
    }

    public function addActualitie($data):void
    {
        $sqlQuery = "INSERT INTO actualities (act_title, act_content, act_date, act_photo) VALUES (?, ?, ?, ?)";
        $this->processOneTableRow($sqlQuery, $data);
    }

    public function deleteActualitieById($id):void
    {
        $sqlQuery = "DELETE FROM actualities WHERE act_id = ?";
        $this->processOneTableRow($sqlQuery,[$id]);
    }
}