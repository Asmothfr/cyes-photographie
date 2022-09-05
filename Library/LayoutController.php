<?php

namespace Library;

class LayoutController
{
     /* 
        * render() permet d'automatiser le chargement du layout.
        * $view = le nom du phtml qui seras affiché.
        * $model = tableau associatif dans lequel nous stockerons la donné venu des Models.
    */
    public function render(string $view, $model=[]): void
    {
        extract($model);
        require_once "App/views/_layout.phtml";
    }
}