<?php
require_once('./controllers/GestionNutritionController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionNutritionView extends GlobalView
{
    public function content()
    {
    }
    public function afficherGestionNutrition()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}