<?php
require_once('./views/GestionNutritionView.php');
require_once('./models/GestionNutritionModel.php');
require_once('./views/PageAjoutIngredientView.php');
require_once('./views/PageModifierIngredientView.php');

class GestionNutritionController
{
    public function getAllIngredients(){
        $model= new GestionNutritionModel();
        return $model->getAllIngredients();
    }
    public function getIngredientById($idIngredient){
        $model= new GestionNutritionModel();
        return $model->getIngredientById($idIngredient);
    }
    public function ajouterIngredient(){
        $nomIngredient = $_POST["nomIngredient"];
        $calories = $_POST["calories"];
        if (isset($_POST["healthy"])) {
            $healthy = 1;
        } else {
            $healthy = 0;
        }
        $saisonNaturelle = $_POST["saisonNaturelle"];
        $proportionHealthy = $_POST["proportionHealthy"];
        $model= new GestionNutritionModel();
        $model->ajouterIngredient(
            $nomIngredient,
            $calories,
            $healthy,
            $saisonNaturelle,
            $proportionHealthy
        );
        header("Location: ./gestion-nutrition");
    }
    public function modifierIngredient(){
        $idIngredient = $_POST["idIngredient"];
        $nomIngredient = $_POST["nomIngredient"];
        $calories = $_POST["calories"];
        if (isset($_POST["healthy"])) {
            $healthy = 1;
            $proportionHealthy = $_POST["proportionHealthy"];
        } else {
            $healthy = 0;
            $proportionHealthy = NULL;
        }
        $saisonNaturelle = $_POST["saisonNaturelle"];
        $model= new GestionNutritionModel();
        $model->modifierIngredient(
            $idIngredient,
            $nomIngredient,
            $calories,
            $healthy,
            $saisonNaturelle,
            $proportionHealthy
        );
        header("Location: ./gestion-nutrition");
    }
    public function supprimerIngredient(){
        $idIngredient = $_POST["idIngredient"];
        $model= new GestionNutritionModel();
        $model->supprimerIngredient($idIngredient);
        header("Location: ./gestion-nutrition");
    }

    public function afficherGestionNutrition(){
        $view = new GestionNutritionView();
        $view->afficherGestionNutrition();
    }
    public function afficherPageAjoutIngredient()
    {
        $view = new PageAjoutIngredientView();
        $view->afficherPageAjoutIngredient();
    }
    public function afficherPageModifierIngredient($idIngredient){
        $view = new PageModifierIngredientView();
        $view->afficherPageModifierIngredient($idIngredient);
    }
}