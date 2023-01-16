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

    <a href="./gestion-recettes" class="admin-link">
        <div class="media-container m-auto overflow-hidden shadow-lg">

            <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
            <h1 class="centered">Gestion des recettes</h1>

        </div>
    </a>

    <a href="./gestion-news" class="admin-link">
        <div class="media-container m-auto overflow-hidden shadow-lg">

            <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
            <h1 class="centered">Gestion des news</h1>

        </div>
    </a>


    <a href="./gestion-users" class="admin-link">
        <div class="media-container m-auto overflow-hidden shadow-lg">

            <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
            <h1 class="centered">Gestion des utilisateurs</h1>

        </div>
    </a>


    <a href="./gestion-nutrition" class="admin-link">
        <div class="media-container m-auto overflow-hidden shadow-lg">

            <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
            <h1 class="centered">Gestion des nutritions</h1>

        </div>
    </a>


    <a href="./parametres" class="admin-link">
        <div class="media-container m-auto overflow-hidden shadow-lg">

            <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
            <h1 class="centered">Pramétres</h1>

        </div>
    </a>

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