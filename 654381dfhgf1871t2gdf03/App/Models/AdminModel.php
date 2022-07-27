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

    public function adminUpdate($column,$data)
    {
        $sqlQuery = "UPDATE admins SET $column =:newData WHERE adm_id=:id ";
        $this->processOneTableRow($sqlQuery, $data);
    }
}