<?php

namespace Library;

class LayoutController
{
    public function render(string $view, $model=[]): void
    {
        extract($model);
        require_once "App/views/_layout.phtml";
    }
}