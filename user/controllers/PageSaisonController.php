<?php
require_once('./views/PageSaisonView.php');
require_once('./models/PageSaisonModel.php');
class PageSaisonController
{

    public function getRecettesSaison($saison)
    {
        $model = new PageSaisonModel();
        return $model->getRecettesSaison($saison);
    }
    public function getSaison()
    {
        $model = new PageSaisonModel();
        return $model->getSaison();
    }
    public function afficherPageSaison()
    {
        $view = new PageSaisonView();
        $view->afficherPageSaison();
    }
}