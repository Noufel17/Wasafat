<?php
require_once('./views/GlobalView.php');
require_once('./views/Components.php');
require_once('./controllers/PageProfileController.php');
class PageProfileView extends GlobalView
{
    public function content($idUser)
    {
        $this->info();
        $controller = new PageProfileController();
        $recettesCrees = $controller->getRecettesByUser($idUser);
        $recettesFavories = $controller->getRecettesFavories($idUser);
        $this->recettesCrees($recettesCrees);
        $this->recettesFavories($recettesFavories);
    }
    public function info()
    {
?>
<div class="container m-auto" style="width:80%;">
    <div class="row row-cols-2">
        <div class="col overflow-hidden d-flex flex-column justify-content-center align-items-center">
            <img src="<?php echo "../public/images/profile" . $_SESSION["user"]["imageProfile"] ?>" alt=""
                class="round mx-auto">
            <div class="mx-auto d-flex flex-column justify-content-center align-items-center" style="margin-top:24px">
                <div class="row row-cols-2">
                    <h2 style="width:fit-content"> <b> <?php echo $_SESSION["user"]["nom"] ?> </b></h2>
                    <h2 style="width:fit-content"> <b> <?php echo $_SESSION["user"]["prenom"] ?></b></h2>
                </div>
            </div>
        </div>

        <div class="col mx-auto my-2 d-flex flex-column justify-content-center align-items-center gap-4">
            <a href="/Projet_tdw/user/ajouter-recette" style="text-decoration:none; font-weight:normal;font-size:24px"
                class="action-btn">Ajouter recette</a>
            <a href="/Projet_tdw/user/modifier-profile" style="text-decoration:none; font-weight:normal;font-size:24px"
                class="action-btn" style="font-size:24px">
                Modifier Profile
            </a>
            <form action="./redirect.php" method="post">
                <button type="submit" class="action-btn" name="logout" style="font-size:24px">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>

</div>
<?php

    }
    public function recettesCrees($recettesCrees)
    {
        $components = new Components();
        $components->searchFilterHeader("Mes recettes", false);
        $components->recettes($recettesCrees);
    }
    public function recettesFavories($recettesFavories)
    {
        $components = new Components();
        $components->searchFilterHeader("Mes recettes favories", false);
        $components->recettes($recettesFavories);
    }
    public function afficherPageProfile($idUser)
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content($idUser);
        $this->footer();
    }
}