<?php
require_once('./controllers/ParametresController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class ParametresView extends GlobalView
{
    public function content()
    {
    }
    public function afficherParametresRecettes()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}