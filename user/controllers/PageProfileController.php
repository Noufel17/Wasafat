<?php
require_once('./views/PageProfileView.php');
require_once('./models/PageProfileModel.php');

class PageProfileController
{
    public function getRecettesByUser($idUser)
    {
        $model = new PageProfileModel();
        return $model->getRecettesByUser($idUser);
    }
    public function getRecettesFavories($idUser)
    {
        $model = new PageProfileModel();
        return $model->getRecettesFavories($idUser);
    }
    public function afficherPageProfile($idUser)
    {
        $view = new PageProfileView();
        $view->afficherPageProfile($idUser);
    }
}