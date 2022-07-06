<?php

namespace App\Models;

use Database\Database;

class ContactModel extends Database
{
    public function getAllMails()
    {
        $sqlQuery = "SELECT * FROM contacts ORDER BY cont_date desc";
        return $this -> findAll($sqlQuery);
    }
}