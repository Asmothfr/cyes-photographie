<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\ContactModel;

class Formcontroller extends LayoutController
{
    public function FormValidation()
    {
        $errors = [];
        if(!isset($_POST["lastname"]) || empty($_POST["lastname"]))
        {
            $errors["e1"] = "Veuillez renseigner votre Nom.";
        }
        if(!isset($_POST["firstname"]) || empty($_POST["firstname"]))
        {
            $errors["e2"] = "Veuillez renseigner votre Prénom.";
        }
        if(!isset($_POST["tel"]) || empty($_POST["tel"]))
        {
            $errors["e3"] = "Veuillez renseigner votre numéro de téléphone.";
        }
        if(!isset($_POST["mail"]) || empty($_POST["mail"]))
        {
            $errors["e4"] = "Veuillez renseigner votre mail.";
        }
        if(!isset($_POST["subject"]) || empty($_POST["subject"]))
        {
            $errors["e5"] = "Veuillez renseigner l'objet de votre demande.";
        }
        if(!isset($_POST["content"]) || empty(trim(($_POST["content"]))))
        {
            $errors["e6"] = "Veuillez renseigner votre demande.";
        }
        if(empty($errors))
        {
            $data = [
                "lastname"=>$_POST["lastname"],
                "firstname"=>$_POST["firstname"],
                "tel"=>$_POST["tel"],
                "mail"=>$_POST["mail"],
                "usr_subject"=>$_POST["subject"],
                "content"=>$_POST["content"]
            ];
            $model = new ContactModel();
            $model->contactFormValidation($data);
            header("location:index.php?route=contact");
        }
        else
        {
            $errorMessage = $errors;
            $this->render("contact", ["errors"=>$errorMessage]);
        }
    }
}