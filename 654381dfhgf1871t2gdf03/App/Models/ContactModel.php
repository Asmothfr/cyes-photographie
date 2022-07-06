<?php

namespace App\Models;

use Database\Database;

class ContactModel extends Database
{
    public function getAllMails():array
    {
        $sqlQuery = "SELECT * FROM contacts ORDER BY cont_date desc";
        return $this -> findAll($sqlQuery);
    }

    public function getOneMail($id):array
    {
        $sqlQuery = "SELECT * FROM contacts WHERE cont_id = ?";
        return $this->find( $sqlQuery, [$id]);
    }

    public function deleteOnemail($id):mixed
    {
        $sqlQuery = "DELETE FROM contacts WHERE cont_id = ?";
        return $this->processOneTableRow($sqlQuery, [$id]);
    }
}