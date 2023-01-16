<?php
require_once('./controllers/PageAcceuilController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class PageAccueilView extends GlobalView
{


    function content()
    {
?>
<div class="container-fluid mx-auto w-75">
    <div class="media-container m-auto overflow-hidden shadow-lg">

        <a href="./gestion-recettes" style="text-decoration:none;z-index=999" height="100%" width="100%">
            <img src="../public/admin/admin1" alt="" height="100%" width="100%">

        </a>
        <h1 class="centered">Gestion des recettes</h1>

    </div>
    <div class="media-container m-auto overflow-hidden shadow-lg">
        <a href="./gestion-news">
            <img src="../public/admin/admin1" alt="" width="100%" height="400px">
        </a>
    </div>
    <div class="media-container m-auto overflow-hidden shadow-lg">
        <a href="./gestion-utilisateurs">
            <img src="../public/admin/admin1" alt="" width="100%" height="400px">
        </a>
    </div>
    <div class="media-container m-auto overflow-hidden shadow-lg">
        <a href="./gestion-nutrition">
            <img src="../public/admin/admin1" alt="" width="100%" height="400px">
        </a>
    </div>
    <div class="media-container m-auto overflow-hidden shadow-lg">
        <a href="./parmetres">
            <img src="../public/admin/admin1" alt="" width="100%" height="400px">
        </a>
    </div>
</div>
<?php
    }

    public function afficher_page_acceuil()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}