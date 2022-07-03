<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\TestModel;

class Formcontroller extends LayoutController
{
    public function testFormValidation()
    {
        $error = [];
        if(!isset($_POST["test1"]) || empty($_POST["test1"]))
        {
            array_push($error,"Veuillez remplir champs 1" );
        }
        if(!isset($_POST["test2"]) || empty($_POST["test2"]))
        {
            array_push($error,"Veuillez remplir champs 2" );
        }
        if(empty($error))
        {
            $data = [
                "d1"=>$_POST["test1"],
                "d2"=>$_POST["test2"],
            ];
            $model = new TestModel();
            $model->contactFormValidation($data);
            $validation = "Merci, votre message a bien été envoyé.";
            $this->render("test_formulaire", ["valid"=>$validation]);
        }
        else
        {
            $errorMessage = $error;
            $this->render("test_formulaire", ["errors"=>$errorMessage]);
        }
    }
}