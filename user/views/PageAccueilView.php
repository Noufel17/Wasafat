<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/controllers/PageAcceuilController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/views/Components.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/views/GlobalView.php');
class PageAccueilView extends GlobalView
{

    public function diaporama()
    {
?>

<div id="diapo" class="carousel slide diaporama" data-bs-ride="carousel">
    <div id="carousel" class="carousel-inner" data-interval="5000">
        <?php
                $controller = new PageAccueilController();
                $images = $controller->getDiapo();
                foreach ($images as $image) {
                    if ($image["idItem"] == 1) {
                ?>
        <div id="<?php echo $image["idItem"] ?>" class="carousel-item active">
            <a href="<?php echo "/Projet_tdw/user" . $image["lienDiapo"] ?>">
                <img src=<?php echo $image["diapoImage"] ?> alt="" class="d-block w-100 carousel-img"
                    style="object-fit:cover">
            </a>
        </div>
        <?php
                    } else {
                    ?>

        <div id="<?php echo $image["idItem"] ?>" class="carousel-item">
            <a href="<?php echo "/Projet_tdw/user" . $image["lienDiapo"] ?>">
                <img src=<?php echo $image["diapoImage"] ?> alt="" class="d-block w-100 carousel-img"
                    style="object-fit:cover">
            </a>
        </div>
        <?php
                    }
                    ?>
        <?php
                }
                ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#diapo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#diapo" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php
    }
    function content()
    {
        $controller = new PageAccueilController();
        $recettesEentrees = $controller->getRecetteByCategory("entrees");
        $components = new Components();
        if ($recettesEentrees) {
            $components->categoryPresentation("Entrees", $recettesEentrees);
        }
        $recettesPlats = $controller->getRecetteByCategory("plats");
        if ($recettesPlats) {
            $components->categoryPresentation("Plats", $recettesPlats);
        }
        $recettesDessert = $controller->getRecetteByCategory("desserts");
        if ($recettesDessert) {
            $components->categoryPresentation("Desserts", $recettesDessert);
        }
        $recettesBoissons = $controller->getRecetteByCategory("boissons");
        if ($recettesBoissons) {
            $components->categoryPresentation("Boissons", $recettesBoissons);
        }
    }

    public function afficher_page_acceuil()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->diaporama();
        $this->content();
        $this->footer();
    }
}