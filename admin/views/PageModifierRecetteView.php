<?php
require_once('./controllers/GestionRecettesController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class PageModifierRecetteView extends GlobalView
{
    public function content($idRecette)
    {
        $controller = new GestionRecettesController();
        $recette = $controller->getRecetteById($idRecette);
        $ingredients = $controller->getIngredientsRecette($idRecette);
        $steps = $controller->getEtapesRecette($idRecette);
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./gestion-recettes" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <input type="hidden" value="<?php echo $idRecette ?>" name="idRecette">
            <div class="form-group w-100">
                <label for="nom">Nom de la recette</label>
                <input type="text" required class="form-control" id="nom" name="nom" placeholder="nom recette"
                    value="<?php echo $recette["nomRecette"] ?>">
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div class="form-group col">
                    <label for="tprepa">Temps de préparation</label>
                    <input type="number" required class="form-control" id="tprepa" name="tprepa"
                        placeholder="temps de preparation en minutes"
                        value="<?php echo $recette["tempsPreparation"] ?>">
                </div>
                <div class="form-group col">
                    <label for="tcuiss">Temps de cuisson</label>
                    <input type="number" required class="form-control" id="tcuiss" name="tcuiss"
                        placeholder="temps de cuission en minutes" value="<?php echo $recette["tempsCuission"] ?>">
                </div>
                <div class="form-group col">
                    <label for="trepos">Temps de repos</label>
                    <input type="number" required class="form-control" id="trepos" name="trepos"
                        placeholder="temps de repos en minutes" value="<?php echo $recette["tempsRepos"] ?>">
                </div>
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2 align-items-center justify-content-center">
                <div class="form-group col">
                    <label for="calories">Nombre de calories</label>
                    <input type="number" class="form-control" id="calories" required name="calories"
                        placeholder="calories en kcal" value="<?php echo $recette["nombreCalories"] ?>">
                </div>
                <div class="form-groupe col " style="margin-top:20px">
                    <?php 
                        if($recette["healthy"]==1){
                            ?>
                    <input class="form-check-input" type="checkbox" checked id="healthy" name="healthy"
                        style="margin-right:10px">
                    <?php
                        }else{
                            ?>
                    <input class="form-check-input" type="checkbox" id="healthy" name="healthy"
                        style="margin-right:10px">
                    <?php
                        }
                    ?>
                    <label class="form-check-label" for="healthy">
                        Healthy
                    </label>
                </div>
            </div>
            <div class="form-row row row-cols-1 row-cols-md-2">
                <div class="form-group col">
                    <label for="diff">Difficulté</label>
                    <select id="diff" name="difficulte" class="form-control" required>
                        <?php
                        if($recette["difficulte"]=="facile"){
                            ?>
                        <option value="facile" selected>Facile</option>
                        <option value="intermediaire">Intermédiaire</option>
                        <option value="difficile">Difficile</option>
                        <?php
                        }
                        if($recette["difficulte"]=="intermediaire"){
                            ?>
                        <option value="intermediaire" selected>Intermédiaire</option>
                        <option value="facile">Facile</option>
                        <option value="difficile">Difficile</option>
                        <?php
                        }
                        if($recette["difficulte"]=="difficile"){
                            ?>
                        <option value="difficile" selected>Difficile</option>
                        <option value="facile">Facile</option>
                        <option value="intermediaire">Intermédiaire</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="category">Catégorie</label>
                    <select id="diff" name="category" class="form-control" required>
                        <?php
                        if($recette["categorie"]=="entrees"){
                            ?>
                        <option value="entrees" selected>Entrées</option>
                        <option value="plats">Plats</option>
                        <option value="desserts">Desserts</option>
                        <option value="boissons">Boissons</option>
                        <?php
                        }
                        if($recette["categorie"]=="plats"){
                            ?>
                        <option value="plats" selected>Plats</option>
                        <option value="entrees">Entrées</option>
                        <option value="desserts">Desserts</option>
                        <option value="boissons">Boissons</option>
                        <?php
                        }
                        if($recette["categorie"]=="desserts"){
                            ?>
                        <option value="desserts" selected>Desserts</option>
                        <option value="entrees">Entrées</option>
                        <option value="plats">Plats</option>
                        <option value="boissons">Boissons</option>
                        <?php
                        }
                        if($recette["categorie"]=="boissons"){
                            ?>
                        <option value="boissons" selected>Boissons</option>
                        <option value="desserts">Desserts</option>
                        <option value="entrees">Entrées</option>
                        <option value="plats">Plats</option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group col">
                    <label for="fete">Fete</label>
                    <select id="diff" name="idFete" class="form-control">
                        <?php
                                $controller = new GestionRecettesController();
                                $fetes = $controller->getFetes();
                                foreach ($fetes as $fete) {
                                    if($fete["idFete"]==$recette["idFete"]){
                                        ?>
                        <option value="<?php echo $fete["idFete"] ?>" selected>
                            <?php echo $fete["nomFete"] ?></option>
                        <?php
                                    }else{
                                        ?>
                        <option value="<?php echo $fete["idFete"] ?>">
                            <?php echo $fete["nomFete"] ?></option>
                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="recetteImage" class="form-label">Image de la recette</label>
                <input class="form-control" type="file" id="recetteImage" name="recetteImage">
            </div>
            <div class="form-group mb-3">
                <label for="recetteVideo" class="form-label">Vidéo de la recette</label>
                <input class="form-control" type="file" id="recetteVideo" name="recetteVideo">
            </div>
            <div class="col-md-12 mb-3">
                <label for="descriptionRecette" class="form-label">Déscription de la recette</label>
                <input type="text" name="descriptionRecette" class="form-control"
                    style="height:200px;overflow-wrap: break-word" required placeholder="déscription de la recette"
                    value="<?php echo $recette["description"] ?>"></input>
            </div>
            <div class="card">
                <div class="card-header">
                    Modifier les Ingrédients de la recette
                </div>
                <div class="card-body">
                    <div id="modifIngredients">
                        <?php
                            foreach($ingredients as $ingredient){
                                ?>
                        <div class="row row-cols-1 row-cols-lg-4 mb-3">
                            <div class="form-group col-md-3">
                                <select name="idIngredient[]" class="form-control" placeholder="choisir un ingredient">
                                    <?php
                                            $controller = new GestionRecettesController();
                                            $ings = $controller->getIngredients();
                                            foreach ($ings as $ing) {
                                                if($ing["idIngredient"]==$ingredient["idIngredient"]){
                                                    ?>
                                    <option value="<?php echo $ing["idIngredient"] ?>" selected>
                                        <?php echo $ing["nomIngredient"] ?></option>
                                    <?php
                                                }else{
                                                    ?>

                                    <option value="<?php echo $ing["idIngredient"] ?>">
                                        <?php echo $ing["nomIngredient"] ?></option>
                                    <?php
                                                }      
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-1">
                                <input type="number" name="quantite[]" class="form-control"
                                    placeholder="quantité de l'ingrédient"
                                    value="<?php echo $ingredient["quantiteIngredient"] ?>">
                            </div>
                            <div class="col-md-3 mb-1">
                                <input type="text" name="unite[]" class="form-control" placeholder="unité de mesure"
                                    value="<?php echo $ingredient["unite"] ?>">
                            </div>
                            <div class="col-md-3 mb-1">
                                <button type="button" class="btn btn-danger remove-ing-btn">
                                    Supprimer Ingrédient
                                </button>
                            </div>
                            <?php
                            if($ingredient["idIngredient"]==end($ingredients)["idIngredient"]){
                                ?>
                            <!-- <div class="col-md-3">
                                <button type="button" class="btn btn-success add-ing-btn">
                                    Ajouter Ingrédient
                                </button>
                            </div> -->
                            <?php
                            }else{
                                ?>
                            <!-- <div class="col-md-3">
                                <button type="button" class="btn btn-danger remove-ing-btn">
                                    Supprimer Ingrédient
                                </button>
                            </div> -->
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter des Ingrédients
                </div>
                <div class="card-body">
                    <div id="ingredients">
                        <div class="row row-cols-1 row-cols-lg-4 mb-3">
                            <div class="form-group col-md-4">
                                <select name="addedIdIngredient[]" class="form-control" required
                                    placeholder="choisir un ingredient">
                                    <option value="0" selected>choisir ingrédient</option>
                                    <?php
                                            $controller = new GestionRecettesController();
                                            $ingsa = $controller->getIngredients();
                                            foreach ($ingsa as $inga) {
                                            ?>
                                    <option value="<?php echo $inga["idIngredient"] ?>">
                                        <?php echo $inga["nomIngredient"] ?></option>
                                    <?php
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-1">
                                <input type="number" name="addedQuantite[]" class="form-control"
                                    placeholder="quantité de l'ingrédient">
                            </div>
                            <div class="col-md-3 mb-1">
                                <input type="text" name="addedUnite[]" class="form-control"
                                    placeholder="unité de mesure">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success add-added-ing-btn">
                                    Ajouter Ingrédient
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Modifier les Etapes de la recette
                </div>
                <div class="card-body">
                    <div id="modifEtapes">
                        <?php
                        foreach($steps as $step){
                            ?>
                        <div class="row row-cols-1 row-cols-md-3 mb-5">
                            <input type="hidden" name="idEtape[]" value="<?php echo $step["idEtape"] ?>">
                            <div class="col-md-4 mb-3">
                                <input type="number" name="numEtape[]" class="form-control" required
                                    placeholder="numéro de l'étape" value="<?php echo $step["numEtape"] ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <input type="text" name="descriptionEtape[]" class="form-control" required
                                    placeholder="description de l'étape" style="height:100px;overflow-wrap:break-word"
                                    value="<?php echo $step["DescriptionEtape"] ?>"></input>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger remove-step-btn">
                                    Supprimer Étape
                                </button>
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter des Etapes
                </div>
                <div class="card-body">
                    <div id="etapes">
                        <div class="row row-cols-1 row-cols-md-3 mb-5">
                            <div class="col-md-4 mb-3">
                                <input type="number" name="addedNumEtape[]" class="form-control"
                                    placeholder="numéro de l'étape">
                            </div>
                            <div class="col-md-12 mb-3">
                                <textarea name="addedDescriptionEtape[]" class="form-control"
                                    placeholder="description de l'étape"></textarea>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success add-added-step-btn">
                                    Ajouter Étape
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center> <button type="submit" class="action-btn" name="modifier-recette">Modifier la recette</button>
            </center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherModifierRecette($idRecette)
    {
        $this->head();
        $this->header();
        $this->content($idRecette);
    }
}