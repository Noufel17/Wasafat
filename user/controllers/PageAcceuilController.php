<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/views/PageAccueilView.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/models/DBconnection.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/models/PageAccueilModel.php');

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