<?php

class Controller
{
    public function displayTest($model=[])
    {
        $model = new Model();
        $list = $model->getListPhoto();

        $view = "test";
        require_once "layout.phtml";
    }
}