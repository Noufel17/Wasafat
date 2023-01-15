<?php
require_once('./views/PageNewsDetailsView.php');
require_once('./models/PageNewsDetailsModel.php');
class PageNewsDetailsController
{
    public function getNewsById($idNews)
    {
        $mode = new PageNewsDetailsModel();
        return $mode->getNewsById($idNews);
    }
    public function afficherPageNewsDetails($idNews)
    {
        $view = new PageNewsDetailsView();
        $view->afficherPageNewsDetails($idNews);
    }
}