<?php

namespace App\Models;

use Library\Database;

class AboutModel extends Database
{
    public function getOneContent(): array
    {
        $sqlQuery = "SELECT * FROM abouts";
        return $this->find($sqlQuery);
    }
}