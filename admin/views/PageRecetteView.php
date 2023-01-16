<?php
require_once('./views/Components.php');
require_once ("./controllers/GestionRecettesController.php");
class PageRecetteView extends GlobalView
{
    public function content($idRecette)
    {
        $controller = new GestionRecettesController();
        $recette = $controller->getRecetteById($idRecette);

        $ingredients = $controller->getIngredientsRecette($idRecette);
        $etapes = $controller->getEtapesRecette($idRecette);
        $description = $recette["description"];
        $components = new Components();
        $components->image($recette["recetteImage"]);
        $this->headerRecette(
            $recette["nomRecette"],
            $recette["difficulte"],
            $recette["notation"],
            $recette["nombreCalories"],
            $idRecette,
            false
        );
        $this->times($recette["tempsPreparation"], $recette["tempsCuission"], $recette["tempsRepos"]);
        $this->description($description);
        $this->ingredients($ingredients);
        $this->etapes($etapes);
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
        <h3 style="margin:0;"><?php if($notation !=NULL){echo $notation . "/5";} else echo "0/5" ?></h3>
        <img src="../public/icons/rating" alt="" height="60px" width="60px">
    </div>
</div>

<?php
    }
    public function times($tempsPreparation, $tempsCuission, $tempsRepos)
    {
    ?>
<div class="m-auto d-flex flex-row justify-content-start align-items-center info-container" style="width:80%;">
    <div style="width:20%;">
        <center><img src="../public/icons/timer" alt=""></center>
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
            <h5 style="font-weight:bold;">Cuisson</h5>
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
        <center> <img src="../public/icons/bowl" alt="" height="40px" width="40px"> </center>
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
        <center> <img src="../public/icons/steps" alt="" height="40px" width="40px"> </center>
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

    public function afficherPageRecette($idRecette)
    {
        $this->head();
        $this->header();
        $this->content($idRecette);
    }
}