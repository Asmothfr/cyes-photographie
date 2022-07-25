<?php

namespace App\Models;

use Database\Database;

class ContactModel extends Database
{
    public function contactFormValidation($data)
    {
        $sqlQuery = "INSERT INTO contacts (cont_usr_lastname, cont_usr_firstname, cont_usr_tel, cont_usr_mail, cont_usr_subject, cont_usr_content) VALUES (:lastname,:firstname,:tel,:mail, :usr_subject, :content)";
        $this->addOne($sqlQuery, $data);
    }
}