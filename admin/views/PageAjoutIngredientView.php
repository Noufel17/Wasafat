<?php
require_once('./views/Components.php');
require_once('./controllers/GestionNutritionController.php');
require_once('./views/GlobalView.php');
class PageAjoutIngredientView extends GlobalView
{
    public function content()
    {
        
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./gestion-nutrition" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <div class="form-group w-100">
                <label for="nom">Nom de l'ingrédient</label>
                <input type="text" required class="form-control" id="nom" name="nomIngredient"
                    placeholder="nom ingrédient">
            </div>
            <div class="form-row d-flex flex-row align-items-center justify-content-center gap-4">
                <div class="form-group" style="min-width:220px">
                    <label for="calories">Nombre de calories</label>
                    <input type="number" class="form-control" id="calories" required name="calories"
                        placeholder="calories par 100 grammes">
                </div>
                <div class="form-groupe cols-md-3 " style="margin-top:20px">
                    <input class="form-check-input" type="checkbox" id="healthy" name="healthy"
                        style="margin-right:10px">
                    <label class="form-check-label" for="healthy">
                        Healthy
                    </label>
                </div>
            </div>
            <div class="form-row row row-cols-1">
                <div class="form-group w-100">
                    <label>Proportion healthy</label>
                    <input type="number" step="0.01" max="1" min="0" class=" form-control" name="proportionHealthy"
                        name="calories" placeholder="la proportion healthy de l'ingrédient">
                </div>
            </div>
            <div class="form-group col">
                <label>saison Naturelle</label>
                <select name="saisonNaturelle" class="form-control" required>
                    <option value="0">choisir saison</option>
                    <option value="automne">Automne</option>
                    <option value="hiver">Hiver</option>
                    <option value="ete">Eté</option>
                    <option value="printemps">Printemps</option>
                    <option value="partout">Partout</option>
                </select>
            </div>
            <center> <button type="submit" class="action-btn" name="ajout-ingredient">Ajouter l'ingrédient</button>
            </center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageAjoutIngredient()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}