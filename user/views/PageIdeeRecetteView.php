<?php
require_once('./controllers/PageIdeeRecetteController.php');
require_once('./controllers/PageSaisonController.php');
require_once('./views/Components.php');
class PageIdeeRecetteView extends GlobalView
{

    public function content()
    {

        $components = new Components();
        $controller = new PageIdeeRecetteController();
        $controller2 = new PageSaisonController();
        $saison = $controller2->getSaison()["saison"];
        $this->ingredientsForm();
        $components->searchFilterHeader("Proposition de recettes", true);
        $this->filters();
        if (isset($_GET['rech-idee-recette'])) {
            $ingredients = $_GET['idIngredient'];
            // si on veut filtrer par ingrédients
            $recettes = $controller->getRecettesByIdeeFilter($ingredients);
        } else {
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
                    $calories
                );
            } else {
                // par defaut on affiche les recettes les mieux notées de la saison en cours
                $recettes = $controller->getRecettesParDefaut($saison);
            }
        }

        $components->recettes($recettes);
    }
    public function ingredientsForm()
    {
?>
<form action="./ideeRecette" method="GET" class="mx-auto idee-form">
    <div class="card">
        <div class="card-header">
            Ajouter vos ingrédients
        </div>
        <div class="card-body">
            <div id="ingredients">
                <div class="row row-cols-2 mb-3 align-items-center">
                    <div class="form-group">
                        <select name="idIngredient[]" class="form-control" required placeholder="choisir un ingredient">
                            <option value="0" selected>choisir ingrédient</option>
                            <?php
                                    $controller = new PageAjoutRecetteController();
                                    $ingredients = $controller->getIngredients();
                                    foreach ($ingredients as $ingredient) {
                                    ?>
                            <option value="<?php echo $ingredient["idIngredient"] ?>">
                                <?php echo $ingredient["nomIngredient"] ?></option>
                            <?php
                                    }
                                    ?>
                        </select>
                    </div>
                    <div>
                        <center>
                            <button class="btn btn-success add-ing-btn-ir" style="font-size:14px">
                                Ajouter ingrédient
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <civ class="card-footer">
            <center> <button type="submit" class="action-btn" name="rech-idee-recette">Rechercher</button></center>
        </civ>

    </div>
</form>
<?php
    }

    public function filters()
    {
    ?>
<form id="filters-form" action="./ideeRecette" class="m-auto d-none" style="width:80%; margin-top:32px !important;">
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
    public function afficherPageIdeeRecette()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}