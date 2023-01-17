<?php
require_once('./views/GestionNutritionView.php');
require_once('./models/GestionNutritionModel.php');

class GestionNutritionController
{
    public function afficherGestionNutrition(){
        $view = new GestionNutritionView();
        $view->afficherGestionNutrition();
    }
}