<?php
require_once('./views/PageIdeeRecetteView.php');
require_once('./models/PageIdeeRecetteModel.php');

class PageIdeeRecetteController
{
    public function getRecettesByIdeeFilter($ingredients)
    {
        $model = new PageIdeeRecetteModel();
        $pourcentage = $model->getPourcentage();
        $Allrecettes = $model->getAllRecettes();
        $recettesToReturn = array();
        foreach ($Allrecettes as $recette) {
            $RecetteIngredients = $model->getIngredientsByrecette($recette["idRecette"]);
            $listOfIds = array();
            foreach ($RecetteIngredients as $rIngredient) {
                array_push($listOfIds, $rIngredient["idIngredient"]);
            }
            $numberOfIngredients = count($listOfIds);
            $counter = 0;
            foreach ($listOfIds as $ingId) {
                if (in_array($ingId, $ingredients)) {
                    $counter++;
                }
            }
            if (($counter / $numberOfIngredients) > 0.7) {
                array_push($recettesToReturn, $recette);
            }
        }
        return $recettesToReturn;
    }
    public function getRecettesParDefaut($saison)
    {
        $model = new PageIdeeRecetteModel();
        return $model->getRecettesParDefaut($saison);
    }
    public function getRecettesByFilter(
        $tprep,
        $tcuiss,
        $ttotal,
        $notation,
        $saison,
        $calories
    ) {
        $model = new PageIdeeRecetteModel();

        $result = $model->getRecettesByFilter(
            $tprep,
            $tcuiss,
            $ttotal,
            $notation,
            $saison,
            $calories
        );
        return $result;
    }
    public function afficherPageIdeeRecette()
    {
        $view = new PageIdeeRecetteView();
        $view->afficherPageIdeeRecette();
    }
}