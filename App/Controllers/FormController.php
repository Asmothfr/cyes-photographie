<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\TestModel;

class Formcontroller extends LayoutController
{
    public function testFormValidation()
    {
        // if( isset($_POST["test1"]) && !empty($_POST["test1"]) &&
        //     isset($_POST["test2"]) && !empty($_POST["test2"]))
        // {
        //     $data = [
        //         "d1"=>$_POST["test1"],
        //         "d2"=>$_POST["test2"],
        //     ];
        //     $model = new TestModel();
        //     $model->contactFormValidation($data);
        //     $this->render("test_formulaire");
        // }
        // else
        // {
        //     $error= "Veuillez remplir tous les champs.";
        //     $this->render("test_formulaire", ["error"=>$error]);
        // }

        // $data = [];
        $errors = [];

        if(isset($_POST["test1"]) && !empty($_POST["test1"]))
        {
            array_push($data, $_POST["test1"]);
        }
        else
        {
            // $error1 = "Veuillez remplir champs 1.";
            array_push($errors,  $error1 = "Veuillez remplir champs 1.");
        }
        if(!isset($_POST["test2"]) && empty($_POST["test2"]))
        {
            array_push($data, $_POST["test2"]);
        }
        else
        {
            $error2 = "Veuillez remplir champs 2.";
            array_push($errors, $error2);
        }
        //je vérifie dans mon tableau d'erreur.
        // if(isset($error1) && !empty($error1))
        if(isset($errors)&&!empty($errors))
        {
            $this->render("test_formulaire",["errors"=>$errors]);
        }
        else
        {
            $data = [
                        "d1"=>$_POST["test1"],
                        "d2"=>$_POST["test2"],
                    ];
                    $model = new TestModel();
                    $model->contactFormValidation($data);
                    $this->render("test_formulaire");
        }
    }
}