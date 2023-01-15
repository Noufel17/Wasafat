<?php
require_once('./views/PageFeteView.php');
require_once('./models/PageFeteModel.php');

class PageFeteController
{
    public function getRecettesFetes()
    {
        $model = new PageFeteModel();
        return $model->getRecettesFetes();
    }
    public function getFetes()
    {
        $model = new PageFeteModel();
        return $model->getFetes();
    }
    public function getRecettesByFete($idFete)
    {
        $model = new PageFeteModel();
        return $model->getRecettesbyFete($idFete);
    }
    public function afficherPageFete()
    {
        $view = new PageFeteView();
        $view->afficherPageFete();
    }
}