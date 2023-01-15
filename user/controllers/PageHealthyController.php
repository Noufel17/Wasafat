<?php
require_once('./views/PageHealthyView.php');
require_once('./models/PageHealthyModel.php');

class PageHealthyController
{
    public function getRecettesHealthy()
    {
        $model = new PageHealthyModel();
        return $model->getRecettesHealthy();
    }
    public function afficherPageHealthy()
    {
        $view = new PageHealthyView();
        $view->afficherPageHealthy();
    }
}