<?php
require_once('./views/Components.php');
require_once('./controllers/PageHealthyController.php');
class PageHealthyView extends GlobalView
{
    public function content()
    {
        $components = new Components();
        $components->searchFilterHeader("Les recettes Healthy", false);
        $controller = new PageHealthyController();
        $recettes = $controller->getRecettesHealthy();
        $components->recettes($recettes);
    }
    public function afficherPageHealthy()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}