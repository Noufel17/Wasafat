<?php
require_once('./views/Components.php');
require_once('./controllers/PageCategoryController.php');
class PageCategoryView extends GlobalView
{
    public function content($idCategory)
    {
        $components = new Components();
        $components->searchFilterHeader(ucfirst($idCategory), true);
        $controller = new PageCategoryController();
        $this->filters($idCategory);
        if (isset($_GET['idee-filter'])) {
            $tprep = $_GET['tprep'];
            $tcuiss = $_GET['tcuiss'];
            $ttotal = $_GET['ttotal'];
            $notation = $_GET['notation'];
            $saison = $_GET['saison'];
            $calories = $_GET['calories'];
            $recettes = $controller->getRecettesByFilter(
                $tprep,
                $tcuiss,
                $ttotal,
                $notation,
                $saison,
                $calories,
                $idCategory
            );
        } else {

            $recettes = $controller->getRecettesByCategory($idCategory);
        }
        $components->recettes($recettes);
    }

    public function filters($idCategory)
    {
?>
<form action="./category" id="filters-form" class="m-auto d-none" style="width:80%; margin-top:32px !important;">
    <div class="form-group m-auto d-flex flex-row justify-content-center align-items-center gap-5">
        <div style="width:25%;">
            <label for="tprep">Filtrer par temps de preparation</label>
            <select class="form-control" id="tprep" name="tprep">
                <option value="-1" selected>Tous</option>
                <option value="1">
                    entre 10 et 30 min</option>
                <option value="2">
                    entre 30 et 60 min </option>
                <option value="3">entre 60 et 90 min </option>
                <option value="4"> plus que 90 min </option>
            </select>
        </div>
        <div style="width:25%;">
            <label for="tcuiss">Filtrer par temps de cuisson</label>
            <select class="form-control" id="tcuiss" name="tcuiss">
                <option value="-1" selected>Tous</option>
                <option value="1">
                    entre 10 et 30 min</option>
                <option value="2">
                    entre 30 et 60 min </option>
                <option value="3">entre 60 et 90 min </option>
                <option value="4"> plus que 90 min </option>
            </select>
        </div>
        <div style="width:25%;">
            <label for="ttotal">Filtrer par temps total</label>
            <select class="form-control" id="ttotal" name="ttotal">
                <option value="-1" selected>Tous</option>
                <option value="1">
                    entre 10 et 30 min</option>
                <option value="2">
                    entre 30 et 60 min </option>
                <option value="3">entre 60 et 90 min </option>
                <option value="4"> plus que 90 min </option>
            </select>
        </div>
    </div>
    <div class="form-group m-auto d-flex flex-row justify-content-center align-items-center gap-5"
        style="margin-top:16px !important;">
        <div style="width:25%;">
            <label for="notation-filter">Filtrer par notation</label>
            <select class="form-control" id="notation" name="notation">
                <option value="-1" selected>Tous</option>
                <option value="1">
                    moin que 2 </option>
                <option value="2">
                    entre 2 et 3 </option>
                <option value="3"> entre 3 et 4 </option>
                <option value="4"> entre 4 et 5</option>
            </select>
        </div>
        <div style="width:25%;">
            <label for="saison">Filtrer par saison</label>
            <select class="form-control" id="saison" name="saison">
                <option value="-1" selected>Tous</option>
                <option value="ete">
                    Été </option>
                <option value="automne">
                    Automne </option>
                <option value="printemps"> Printemps </option>
                <option value="hiver"> Hiver </option>
            </select>
        </div>
        <div style="width:25%;">
            <label for="calories">Filtrer par nombre de calories</label>
            <select class="form-control" id="calories" name="calories">
                <option value="-1" selected>Tous</option>
                <option value="1">
                    moin que 500 kcal </option>
                <option value="2">
                    entre 500 et 1000 kcal </option>
                <option value="3"> entre 1000 et 2000 kcal </option>
                <option value="4"> plus que 2000 kcal </option>
            </select>
        </div>
    </div>
    <input type="hidden" name="idCategory" value="<?php echo $idCategory ?>">
    <div class="d-flex flex-row justify-content-between align-items-center mt-4 w-75 m-auto">
        <button type="submit" name="idee-filter" class="action-btn">
            Valider
        </button>
        <button type="button" id="hide-filters-btn" class="action-btn">
            Cacher les filtres
        </button>
    </div>
</form>
<?php
    }

    public function afficherPageCategory($idCategory)
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content($idCategory);
        $this->footer();
    }
}