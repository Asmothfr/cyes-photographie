<?php

namespace Library;

class LayoutController
{
    protected function render(string $view, $model=[]): void
    {
        extract($model);
        $view = $view;
        require_once "App/views/_layout.phtml";
    }
}