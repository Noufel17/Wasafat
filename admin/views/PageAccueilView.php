<?php
require_once('./controllers/PageAcceuilController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class PageAccueilView extends GlobalView
{


    function content()
    {
?>
<div class="container-fluid row row-cols-1 row-cols-lg-2 mx-auto w-100">

    <div class="col">
        <a href="./gestion-recettes" class="admin-link">
            <div class="media-container m-auto overflow-hidden shadow-lg">

                <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
                <h1 class="centered">Gestion des recettes</h1>

            </div>
        </a>
    </div>

    <div class="col">
        <a href="./gestion-news" class="admin-link">
            <div class="media-container m-auto overflow-hidden shadow-lg">

                <img src="../public/admin/admin2" alt="" height="100%" width="100%" style="object-fit:cover">
                <h1 class="centered">Gestion des news</h1>

            </div>
        </a>
    </div>


    <div class="col">
        <a href="./gestion-users" class="admin-link">
            <div class="media-container m-auto overflow-hidden shadow-lg">

                <img src="../public/admin/users" alt="" height="100%" width="100%" style="object-fit:cover">
                <h1 class="centered">Gestion des utilisateurs</h1>

            </div>
        </a>
    </div>


    <div class="col">
        <a href="./gestion-nutrition" class="admin-link">
            <div class="media-container m-auto overflow-hidden shadow-lg">

                <img src="../public/admin/admin1" alt="" height="100%" width="100%" style="object-fit:cover">
                <h1 class="centered">Gestion des nutritions</h1>

            </div>
        </a>
    </div>


    <div class="col">
        <a href="./parametres" class="admin-link">
            <div class="media-container m-auto overflow-hidden shadow-lg">

                <img src="../public/admin/settings" alt="" height="100%" width="100%" style="object-fit:cover">
                <h1 class="centered">Pramétres</h1>

            </div>
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