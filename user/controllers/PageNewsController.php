<?php
require_once('./views/PageNewsView.php');
require_once('./models/PageNewsModel.php');
class PageNewsController
{
    public function getNews()
    {
        $view = new PageNewsModel();
        return $view->getNews();
    }
    public function afficherPageNews()
    {
        $view = new PageNewsView();
        $view->afficherPageNews();
    }
}