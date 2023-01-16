<?php
require_once('./views/Components.php');
require_once('./controllers/PageAjoutRecetteController.php');
require_once('./views/GlobalView.php');
class PageAjoutRecetteView extends GlobalView
{
    public function content()
    {
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <a href="<?php echo "./profile?idUser=" . $_SESSION["user"]["idUtilisateur"] ?>" class="action-btn"
                style="text-decoration:none;">retourner</a>
            <input type="hidden" name="idUser" value="<?php echo $_SESSION["user"]["idUtilisateur"] ?>">
            <div class="form-group w-100">
                <label for="nom">Nom de la recette</label>
                <input type="text" required class="form-control" id="nom" name="nom" placeholder="nom recette">
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div class="form-group col">
                    <label for="tprepa">Temps de préparation</label>
                    <input type="number" required class="form-control" id="tprepa" name="tprepa"
                        placeholder="temps de preparation en minutes">
                </div>
                <div class="form-group col">
                    <label for="tcuiss">Temps de cuisson</label>
                    <input type="number" required class="form-control" id="tcuiss" name="tcuiss"
                        placeholder="temps de cuission en minutes">
                </div>
                <div class="form-group col">
                    <label for="trepos">Temps de repos</label>
                    <input type="number" required class="form-control" id="trepos" name="trepos"
                        placeholder="temps de repos en minutes">
                </div>
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2 align-items-center justify-content-center">
                <div class="form-group col">
                    <label for="calories">Nombre de calories</label>
                    <input type="number" class="form-control" id="calories" required name="calories"
                        placeholder="calories en kcal">
                </div>
                <div class="form-groupe col " style="margin-top:20px">
                    <input class="form-check-input" type="checkbox" id="healthy" name="healthy"
                        style="margin-right:10px">
                    <label class="form-check-label" for="healthy">
                        Healthy
                    </label>
                </div>
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2">
                <div class="form-group col">
                    <label for="diff">Difficulté</label>
                    <select id="diff" name="difficulte" class="form-control" required>
                        <option value="0" selected>choisir difficulté</option>
                        <option value="facile">Facile</option>
                        <option value="intermediaire">Intermédiaire</option>
                        <option value="difficile">Difficile</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="category">Catégorie</label>
                    <select id="diff" name="category" class="form-control" required>
                        <option value="0" selected>choisir catégorie</option>
                        <option value="entrees">Entrées</option>
                        <option value="plats">Plats</option>
                        <option value="desserts">Desserts</option>
                        <option value="boissons">Boissons</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="fete">Fete</label>
                    <select id="diff" name="idFete" class="form-control">
                        <option value="0" selected>choisir Fete</option>
                        <?php
                                $controller = new PageAjoutRecetteController();
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
            </div>
            <div class="form-group mb-3">
                <label for="recetteImage" class="form-label">Image de la recette</label>
                <input class="form-control" type="file" id="recetteImage" name="recetteImage" required>
            </div>
            <div class="form-group mb-3">
                <label for="recetteVideo" class="form-label">Vidéo de la recette</label>
                <input class="form-control" type="file" id="recetteVideo" name="recetteVideo">
            </div>
            <div class="col-md-12 mb-3">
                <label for="descriptionRecette" class="form-label">Déscription de la recette</label>
                <textarea name="descriptionRecette" class="form-control" style="height:200px" required
                    placeholder="déscription de la recette"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter les Ingrédients de la recette
                </div>
                <div class="card-body">
                    <div id="ingredients">
                        <div class="row row-cols-1 row-cols-lg-4 mb-3">
                            <div class="form-group col-md-4">
                                <select name="idIngredient[]" class="form-control" required
                                    placeholder="choisir un ingredient">
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
                            <div class="col-md-3 mb-1">
                                <input type="number" name="quantite[]" class="form-control" required
                                    placeholder="quantité de l'ingrédient">
                            </div>
                            <div class="col-md-3 mb-1">
                                <input type="text" name="unite[]" class="form-control" placeholder="unité de mesure">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success add-ing-btn">
                                    Ajouter Ingrédient
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter les Etapes de la recette
                </div>
                <div class="card-body">
                    <div id="etapes">
                        <div class="row row-cols-1 row-cols-md-3 mb-5">
                            <div class="col-md-4 mb-3">
                                <input type="number" name="numEtape[]" class="form-control" required
                                    placeholder="numéro de l'étape">
                            </div>
                            <div class="col-md-12 mb-3">
                                <textarea name="descriptionEtape[]" class="form-control" required
                                    placeholder="description de l'étape"></textarea>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success add-step-btn">
                                    Ajouter Étape
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <center> <button type="submit" class="action-btn" name="ajout-recette">Ajouter la recette</button></center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageAjoutRecette()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}