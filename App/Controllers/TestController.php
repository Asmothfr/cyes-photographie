<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\TestModel;

class TestController extends LayoutController
{
    public function displayTest(): void
    {
        $model = new TestModel;
        $photosList = $model->getPhotosList();

        $this->render("test", ["photos" => $photosList]);
    }
}