<?php
require_once('./views/PageCategoryView.php');
require_once('./models/PageCategoryModel.php');

class PageCategoryController
{
    public function getRecettesByFilter(
        $tprep,
        $tcuiss,
        $ttotal,
        $notation,
        $saison,
        $calories,
        $idCategory
    ) {
        $model = new PageCategoryModel();

        $result = $model->getRecettesByFilter(
            $tprep,
            $tcuiss,
            $ttotal,
            $notation,
            $saison,
            $calories,
            $idCategory
        );
        return $result;
    }
    public function getRecettesByCategory($idCategory)
    {
        $model = new PageCategoryModel();
        return $model->getRecettesByCategory($idCategory);
    }
    public function afficherPageCategory($idCategory)
    {
        $view = new PageCategoryView();
        $view->afficherPageCategory($idCategory);
    }
}