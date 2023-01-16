<?php
require_once('./views/PageAccueilView.php');
require_once('./models/DBconnection.php');
require_once('./models/PageAccueilModel.php');

class PageAccueilController
{
    public function getRecetteByCategory($category)
    {
        $model = new PageAccueilModel();
        return $model->getRecetteByCategory($category);
    }
    public function getMenu()
    {
        $model = new PageAccueilModel();
        return $model->getMenu();
    }
    public function getReseauxSociaux()
    {
        $model = new PageAccueilModel();
        return $model->getResauxSociaux();
    }
    public function getDiapo()
    {
        $model = new PageAccueilModel();
        return $model->getDiapo();
    }
    public function afficherPageAccueil()
    {
        $view = new PageAccueilView;
        $view->afficher_page_acceuil();
    }
}