<?php
require_once('./views/ParametresView.php');
require_once('./models/ParametresModel.php');

class ParametresController
{
    public function afficherParametres(){
        $view = new ParametresView();
        $view->afficherParametres();
    }
}