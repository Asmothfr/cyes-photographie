<?php

namespace App\Models;

use Database\Database;

class AdminModel extends Database
{
    public function adminInfo()
    {
        $sqlQuery = "SELECT * FROM admins";
        return $this->find($sqlQuery);
    }

    public function adminUpdate($column, $data, $id)
    {
        $sqlQuery = "UPDATE admins SET $column = '$data' WHERE adm_id = ?";
        $this->addOnecolumn($sqlQuery, [$id]);
    }
}