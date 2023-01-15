<?php
require_once('./views/PageIngredientView.php');
class PageIngredientController
{
    public function afficherPageIngredient($idIngredient)
    {
        $view = new PageIngredientView();
        $view->afficherPageIngredient($idIngredient);
    }
}