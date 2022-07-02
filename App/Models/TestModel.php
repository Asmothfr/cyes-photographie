<?php

namespace App\Models;

use Database\Database;

class TestModel extends Database
{
    public function contactFormValidation($data)
    {
        $sqlQuery = "INSERT INTO test (toto, titi) VALUES (:d1,:d2)";
        $this->addOne($sqlQuery, $data);
    }
}