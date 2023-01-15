<?php
require_once('./views/Components.php');
require_once('./controllers/PageFeteController.php');
class PageFeteView extends GlobalView
{
    public function content()
    {
        // missing integration
        $components = new Components();
        $components->searchFilterHeader("Recettes des Fetes", true);
        $this->filter();
        $controller = new PageFeteController();
        if (isset($_GET['idFete'])) {
            $idFete = $_GET['idFete'];
            $recettes = $controller->getRecettesByFete($idFete);
        } else {
            $recettes = $controller->getRecettesFetes();
        }
        $components->recettes($recettes);
    }

    public function filter()
    {
?>
<form id="filters-form" class="mx-auto d-none" style="width:60%;margin-bottom:32px" action="./fete" method="GET">
    <div class="row row-cols-1 row-cols-md-2 justify-content-between">
        <div class="col form-group" style="width:300px">
            <label for="fete-filter">Filtrer par fete</label>
            <select class="form-control" id="fete-filter" name="idFete">
                <option value="0" selected>Tous</option>
                <?php
                        $controller = new PageFeteController();
                        $fetes = $controller->getFetes();
                        foreach ($fetes as $fete) {
                        ?>
                <option value="<?php echo $fete["idFete"] ?>">
                    <?php echo $fete["nomFete"] ?></option>
                <?php
                        }
                        ?>

            </select>
        </div>
        <div class="col d-flex flex-row align-items-center justify-content-end gap-4" style="margin-top:20px">
            <button type=" submit" name="fete-filter" class="action-btn">
                Valider
            </button>
            <button type="button" id="hide-filters-btn" class="action-btn">
                Cacher le filtres
            </button>
        </div>
    </div>
</form>
<?php
    }
    public function afficherPageFete()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}