<?php
require_once('./controllers/GestionRecettesController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionRecettesView extends GlobalView
{
    public function content()
    {
    }
    public function afficherGestionRecettes()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}