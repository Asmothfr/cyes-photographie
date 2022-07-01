<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\TestModel;

class Formcontroller extends LayoutController
{
    public function testFormValidation()
    {
        $testdata1 = false;
        $testdata2 = false;
        $error = [];
        if(isset($_POST["test1"]) && !empty($_POST["test1"]))
        {
            $testdata1 = true;
        }
        else
        {
            array_push($error,"Veuillez remplir champs 1" );
        }
        if(isset($_POST["test2"]) && !empty($_POST["test2"]))
        {
            $testdata2 = true;
        }
        else
        {
            array_push($error,"Veuillez remplir champs 2" );
        }
        if($testdata1 && $testdata2)
        {
            $data = [
                "d1"=>$_POST["test1"],
                "d2"=>$_POST["test2"],
            ];
            $model = new TestModel();
            $model->contactFormValidation($data);
            $this->render("test_formulaire");
        }
        if(isset($error) && !empty($error))
        {
            $errorMessage = $error;
            $this->render("test_formulaire", ["errors"=>$errorMessage]);
        }
    }
}