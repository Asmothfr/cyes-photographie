<?php

namespace Library;

abstract class LayoutController
{
    public function render(string $view, $model=[]): void
    {
        extract($model);
        require_once "App/views/layout.phtml";
    }
}