<?php
require_once('./views/Components.php');
require_once('./controllers/PageIngredientController.php');
class PageIngredientView extends GlobalView
{
    public function content($idIngredient)
    {
    }
    public function afficherPageIngredient($idIngredient)
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content($idIngredient);
        $this->footer();
    }
}