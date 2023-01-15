<?php
require_once('./views/Components.php');
require_once "./controllers/PageRecetteController.php";
class PageRecetteView extends GlobalView
{
    public function content($idRecette)
    {
        $controller = new PageRecetteController();
        $recette = $controller->getRecetteById($idRecette);

        $ingredients = $controller->getIngredientsRecette($idRecette);
        $etapes = $controller->getEtapesRecette($idRecette);
        $description = $recette["description"];
        $components = new Components();
        $components->image($recette["recetteImage"]);
        if (isset($_SESSION["user"])) {
            $favorie = $controller->verifyFavorie($_SESSION["user"]["idUtilisateur"], $idRecette);
        } else {
            $favorie = false;
        }
        $this->headerRecette(
            $recette["nomRecette"],
            $recette["difficulte"],
            $recette["notation"],
            $recette["nombreCalories"],
            $idRecette,
            $favorie
        );
        $this->times($recette["tempsPreparation"], $recette["tempsCuission"], $recette["tempsRepos"]);
        $this->description($description);
        $this->ingredients($ingredients);
        $this->etapes($etapes);
        if (isset($_SESSION["user"])) {
            $this->notation($idRecette);
        }
        $components->video($recette["recetteVideo"]);
    }

    public function headerRecette($nomRecette, $difficulte, $notation, $calories, $idRecette, $favorie)
    {
?>
<div class="m-auto d-flex flex-row justify-content-between align-items-center" style="width:80%;">
    <div class="d-flex flex-column justify-content-center ">
        <h2 style="font-weight:bold;"><?php echo $nomRecette ?></h2>
        <h3>
            <?php echo "Difficulté : " .  $difficulte ?>
        </h3>
        <h3>
            <?php echo "Calories : " .  $calories . " kcal" ?>
        </h3>
    </div>
    <div class="d-flex flex-row justify-content-center align-items-center gap-2">
        <h3 style="margin:0;"><?php echo $notation . "/5" ?></h3>
        <img src="./public/icons/rating" alt="" height="60px" width="60px">
    </div>
    <?php
            if (isset($_SESSION["user"]) && !$favorie) {
            ?>
    <div>
        <form action="./redirect.php" method="post">
            <input type="number" name="idRecette" hidden value="<?php echo $idRecette ?>" />
            <input type="number" name="idUser" hidden value="<?php echo $_SESSION["user"]["idUtilisateur"] ?>" />
            <button type="submit" class="action-btn" name="favories">
                Ajouter au favories
            </button>
        </form>
    </div>
    <?php
            }
            if (isset($_SESSION["user"]) && $favorie) {
            ?>
    <h3>ajoutée au favories</h3>
    <form action="./redirect.php" method="post">
        <input type="number" name="idRecette" hidden value="<?php echo $idRecette ?>" />
        <input type="number" name="idUser" hidden value="<?php echo $_SESSION["user"]["idUtilisateur"] ?>" />
        <button type="submit" class="action-btn" name="remove-favorie">
            Enlever des favories
        </button>
    </form>
    <?php
            }
            ?>

</div>

<?php
    }
    public function times($tempsPreparation, $tempsCuission, $tempsRepos)
    {
    ?>
<div class="m-auto d-flex flex-row justify-content-start align-items-center info-container" style="width:80%;">
    <div style="width:20%;">
        <center><img src="./public/icons/timer" alt=""></center>
    </div>
    <div class="row row-cols-4" style="width:80%;">
        <div class="col d-flex flex-column justify-content-center align-items-center gap-2">
            <h5 style="font-weight:bold;">
                Préparation
            </h5>
            <div>
                <?php
                        echo $tempsPreparation . " min"
                        ?>
            </div>
        </div>

        <div class="col d-flex flex-column justify-content-center align-items-center gap-2">
            <h5 style="font-weight:bold;">Cuission</h5>
            <div>
                <?php
                        echo $tempsCuission . " min"
                        ?>
            </div>
        </div>

        <div class="col d-flex flex-column justify-content-center align-items-center gap-2">
            <h5 style="font-weight:bold;">Repos</h5>
            <div>
                <?php
                        echo $tempsRepos . " min"
                        ?>
            </div>
        </div>

        <div class="col d-flex flex-column justify-content-center align-items-center gap-2">
            <h5 style="font-weight:bold;">Total</h5>
            <div>
                <?php
                        echo $tempsCuission + $tempsPreparation + $tempsRepos . " min"
                        ?>
            </div>
        </div>
    </div>

</div>

<?php
    }
    public function Description($description)
    {
    ?>
<div class="m-auto description">
    <p><?php echo $description ?></p>
</div>
<?php
    }
    public function ingredients($listIngredients)
    {
    ?>
<div class="info-container m-auto d-flex flex-row justify-content-start align-items-center " style="width:80%;">
    <div style="width:30%;">
        <center> <img src="./public/icons/bowl" alt="" height="40px" width="40px"> </center>
    </div>
    <div class="row row-cols-3 row-cols-lg-4 gap-5">
        <?php
                foreach ($listIngredients as $ingredient) {
                ?>
        <div class="col" style="margin-bottom:32px;min-width:fit-content">
            <h5 style="font-weight:bold;"><?php echo $ingredient["nomIngredient"] ?></h5>
            <div style="font-weight:normal;">
                <?php
                            echo "Quantité : " . $ingredient["quantiteIngredient"] . " " . $ingredient["unite"]
                            ?>
            </div>
        </div>
        <?php
                }
                ?>

    </div>
</div>
<?php
    }
    public function etapes($listEtapes)
    {
    ?>
<div class="info-container m-auto d-flex flex-row justify-content-start align-items-center " style="width:80%;">
    <div style="width:20%;">
        <center> <img src="./public/icons/steps" alt="" height="40px" width="40px"> </center>
    </div>
    <div class=" row row-cols-1 d-flex flex-column gap-2 justify-content-center align-items-center" style="width:80%;">
        <?php
                foreach ($listEtapes as $etape) {
                ?>
        <div class="col" style="margin-bottom:32px;">
            <h3 style="font-weight:bold;"><?php echo "Etape " . $etape["numEtape"] ?></h3>
            <p style="max-width:90%;font-weight:normal;">
                <?php
                            echo $etape["descriptionEtape"]
                            ?>
            </p>

        </div>
        <?php
                }
                ?>
    </div>
</div>
<?php
    }
    public function notation($idRecette)
    {
    ?>
<div class="m-auto d-flex flex-column justify-content-center align-items-center" style="width:80%;">
    <h2>Noter la recette</h2>
    <form action="./redirect.php" method="post" class="d-flex flex-column justify-content-center align-items-center">
        <input type="number" name="idRecette" hidden value="<?php echo $idRecette ?>" />
        <input type="number" name="idUser" hidden value="<?php echo $_SESSION["user"]["idUtilisateur"] ?>" />
        <fieldset class="rating m-auto">
            <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5"></label>
            <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4"></label>
            <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3"></label>
            <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2"></label>
            <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1"></label>
            <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf"></label>
        </fieldset>
        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" class="action-btn m-auto" name="notation">
                Valider
            </button>
        </div>

    </form>

</div>

<?php
    }

    public function afficherPageRecette($idRecette)
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content($idRecette);
        $this->footer();
    }
}