<?php
require_once('./views/Components.php');
require_once('./controllers/PageSaisonController.php');
class PageSaisonView extends GlobalView
{
    public function content()
    {
        $controller = new PageSaisonController();
        $saison = $controller->getSaison()["saison"];
        $recettes = $controller->getRecettesSaison($saison);
        $components = new Components();
        $components->searchFilterHeader("Recettes pour l'" . $saison, false);
        $components->recettes($recettes);
    }

    public function afficherPageSaison()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}