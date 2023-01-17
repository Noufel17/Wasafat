<?php
require_once('./views/GlobalView.php');
require_once('./views/Components.php');
require_once('./controllers/GestionUsersController.php');
class PageProfileView extends GlobalView
{
    public function content($idUser)
    {
        $controller = new GestionUsersController();
        $user = $controller->getUserById($idUser);
        $this->info($user);
        $recettesCrees = $controller->getRecettesByUser($idUser);
        $recettesFavories = $controller->getRecettesFavories($idUser);
        $this->recettesCrees($recettesCrees);
        $this->recettesFavories($recettesFavories);
    }
    public function info($user)
    {
?>
<div class="container m-auto" style="width:80%;">
    <div class="row row-cols-1">
        <div class="col overflow-hidden d-flex flex-column justify-content-center align-items-center">
            <img src="<?php echo "../public/images/profile" . $user["imageProfile"] ?>" alt="" class="round mx-auto">
            <div class="mx-auto d-flex flex-column justify-content-center align-items-center" style="margin-top:24px">
                <div class="row row-cols-2">
                    <h2 style="width:fit-content"> <b> <?php echo $user["nom"] ?> </b></h2>
                    <h2 style="width:fit-content"> <b> <?php echo $user["prenom"] ?></b></h2>
                </div>
            </div>
        </div>
        <a href="./gestion-users" class="action-btn" style="test-decoration:none">
            Retour
        </a>

        <!-- <div class="col mx-auto my-2 d-flex flex-column justify-content-center align-items-center gap-4">
        </div> -->
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
        $this->content($idUser);
    }
}