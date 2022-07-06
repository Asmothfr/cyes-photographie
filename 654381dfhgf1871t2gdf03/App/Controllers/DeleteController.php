<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\ContactModel;

class DeleteController extends LayoutController
{
    public function deleteOneMail()
    {
        $id = $_GET["id"];
        $model = new ContactModel;
        $mail = $model->deleteOneMail($id);
        header("location: index.php?route=mails");
    }
}



