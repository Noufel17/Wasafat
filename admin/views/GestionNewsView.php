<?php
require_once('./controllers/GestionNewsController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionNewsView extends GlobalView
{
    public function content()
    {
    }
    public function afficheNewsRecettes()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}