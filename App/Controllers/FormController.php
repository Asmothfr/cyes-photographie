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
            $errors["e1"] = "Veuillez renseigner votre prénom.";
        }
        if(!isset($_POST["firstname"]) || empty($_POST["firstname"]))
        {
            $errors["e2"] = "Veuillez renseigner votre nom.";
        }
        if(!isset($_POST["tel"]) || empty($_POST["tel"]))
        {
            $errors["e3"] = "Veuillez renseigner votre numéro de téléphone.";
        }
        if(!isset($_POST["mail"]) || empty($_POST["mail"]))
        {
            $errors["e4"] = "Veuillez renseigner votre mail.";
        }
        if(!isset($_POST["content"]) || empty($_POST["content"]))
        {
            $errors["e5"] = "Veuillez renseigner votre demande.";
        }
        if(empty($errors))
        {
            $data = [
                "lastname"=>$_POST["lastname"],
                "firstname"=>$_POST["firstname"],
                "tel"=>$_POST["tel"],
                "mail"=>$_POST["mail"],
                "content"=>$_POST["content"]
            ];
            $model = new ContactModel();
            $model->contactFormValidation($data);
            $validation = "Merci, votre message a bien été envoyé.";
            header("location:index.php?route=contact");
        }
        else
        {
            $errorMessage = $errors;
            $this->render("contact", ["errors"=>$errorMessage]);
        }
    }
}