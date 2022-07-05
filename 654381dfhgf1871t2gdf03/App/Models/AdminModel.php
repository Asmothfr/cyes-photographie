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
}