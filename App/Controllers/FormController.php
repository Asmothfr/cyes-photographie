<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\TestModel;

class Formcontroller extends LayoutController
{
    public function testFormValidation()
    {
        try
        {
            if( isset($_POST["test1"]) && !empty($_POST["test1"]) &&
                isset($_POST["test2"]) && !empty($_POST["test2"]))
            {
                $data = [
                    "d1"=>$_POST["test1"],
                    "d2"=>$_POST["test2"],
                ];
                $model = new TestModel();
                $model->contactFormValidation($data);
                header( 'Location: index.php?route=test' );
                
            }
            else
            {
                throw new \Exception("Veuillez remplir tous les champs.");
            }
            
        }
        catch( \Exception $e )
        {
            $errorMessage = $e->getMessage();
            header('Location: index.php?route=test&errorMessage=' . $errorMessage);
            exit();
        }
    }
}