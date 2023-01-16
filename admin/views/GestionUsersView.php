<?php
require_once('./controllers/GestionUsersController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionUsersView extends GlobalView
{
    public function content()
    {
    }
    public function afficherUsersRecettes()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}