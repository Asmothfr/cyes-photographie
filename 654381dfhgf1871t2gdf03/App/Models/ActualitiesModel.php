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
}