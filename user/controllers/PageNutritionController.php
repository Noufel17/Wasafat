<?php
require_once('./views/PageNutritionView.php');
require_once('./models/PageNutritionModel.php');
class PageNutritionController
{
    public function getIngredients()
    {
        $model = new PageNutritionModel();
        return $model->getIngredients();
    }
    public function afficherPageNutrition()
    {
        $view = new PageNutritionView();
        $view->afficherPageNutrition();
    }
}