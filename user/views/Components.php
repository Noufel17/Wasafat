<?php
class Components
{
    public function cardRecette($id, $image, $title, $description)
    {
?>
<div class="card card-style shadow m-auto" style="width:274px; height:410px">
    <img class="card-img-top" src="<?php echo "../public/images/recettes" . $image ?>" alt="" height="200px">
    <div class="card-body">
        <h5 class="card-title" style="font-weight:bold"><?php echo $title ?></h5>
        <p class="card-text" style="font-weight:normal"><?php echo $description ?></p>
        <center>
            <a href="<?php echo "/Projet_tdw/user/recette?idRecette=" . strtolower($id) ?>" class="action-btn">Afficher
                la suite</a>
        </center>
    </div>
</div>
<?php
    }
    public function cardNews($id, $image, $title, $description)
    {
    ?>
<div class="card card-style shadow m-auto" style="width:274px;">
    <img class="card-img-top" src="<?php echo "../public/images/news" . $image ?>" alt="" height="200px">
    <div class="card-body">
        <h5 class="card-title" style="font-weight:bold"><?php echo $title ?></h5>
        <p class="card-text" style="font-weight:normal"><?php echo $description ?></p>
        <center>
            <a href="<?php echo "/Projet_tdw/user/news-details?idNews=" . strtolower($id) ?>"
                class="action-btn">Afficher
                la suite</a>
        </center>
    </div>
</div>
<?php
    }
    public function cardIngredient($id, $nom, $healthy,$proportionHealthy,$saison,$calories)
    {
    ?>
<div class="card card-style shadow m-auto" style="width:274px;">
    <div class="card-header">
        <h3 style="font-weight:bold"><?php echo $nom ?></h3>
    </div>
    <div class="card-body">
        <?php
                if ($healthy == 1) {
                ?>
        <div class="d-flex flex-row justify-content-start align-items-center gap-2">
            <img src="../public/icons/healthy" alt="" width="40px" height="40px">
            <h3>Healthy</h3>
            <?php
            if($proportionHealthy !=NULL){
                ?>
            <h5><?php echo "à " . $proportionHealthy * 100 . " %" ?></h5>
            <?php
            }
            ?>

        </div>
        <?php
                } else {
                ?>
        <?php
                }
                ?>
        <h5><b>Saison Naturelle:</b> <?php echo ucfirst($saison) ?></h5>
        <?php if($calories != NULL){
            ?>
        <h5><b>Calories: </b><?php echo $calories . " cal/100g" ?></h5>
        <?php
        } ?>

    </div>
</div>
<?php
    }
    public function categoryPresentation($title, $recettes)
    {
    ?>
<div class="category-presentation">
    <center>
        <a href="<?php echo "/Projet_tdw/user/category?idCategory=" . strtolower($title) ?>">
            <h1 style="font-weight: bold;"><?php echo $title ?></h1>
        </a>

    </center>
    <div class="container-fluid py-2 overflow-hidden" style="max-width:80%;">
        <div class="d-flex flex-row justify-content-start flex-nowrap gap-4 overflow-scroll py-4">
            <?php
                    foreach ($recettes as $recette) {
                        $this->cardRecette(
                            $recette["idRecette"],
                            $recette["recetteImage"],
                            $recette["nomRecette"],
                            substr($recette["description"], 0, 120) . "..."
                        );
                    }


                    ?>
        </div>
    </div>
</div>
<?php
    }
    public function image($lienImage)
    {
    ?>
<div class="media-container m-auto overflow-hidden">
    <img src="<?php echo "../public/images/recettes" . $lienImage ?>" alt="" width="100%"
        style="max-height:600px;object-fit:cover">
</div>
<?php
    }
    public function imageNews($lienImage)
    {
    ?>
<div class="media-container m-auto overflow-hidden">
    <img src="<?php echo "../public/images/news" . $lienImage ?>" alt="" width="100%"
        style="max-height:600px;object-fit:cover">
</div>
<?php
    }
    public function video($lienVideo)
    {
        if (isset($lienVideo)) {
        ?>

<div class="media-container m-auto overflow-hidden w-100">
    <video width="100%" src="<?php echo "../public/videos/recettes" . $lienVideo ?>" controls muted></video>
</div>
<?php
        }
    }
    public function searchFilterHeader($title, $filter)
    {
        ?>
<div class="d-flex flex-row justify-content-between align-items-center mx-auto my-5" style="width:80%;">
    <h1><?php echo $title ?></h1>
    <div class="d-flex flex-row justify-content-center align-items-center gap-4">
        <input class="form-control form-control-lg mr-sm-2" style="height:32px" type="search" placeholder="recherche"
            aria-label="Search" id="search-bar">
        <button id="sort-btn" class="action-btn">
            Trier
        </button>
        <?php
                if ($filter) {
                ?>
        <button id="filter-btn" class="action-btn">
            Filtrer
        </button>
        <?php
                }
                ?>

    </div>

</div>
<?php
    }
    public function recettes($recettes)
    {
    ?>
<div class="card-deck row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 m-auto" style="width:80%;">

    <?php
            $components = new Components();
            foreach ($recettes as $recette) {
            ?>
    <div class="col">
        <?php
                    $components->cardRecette(
                        $recette["idRecette"],
                        $recette["recetteImage"],
                        $recette["nomRecette"],
                        substr($recette["description"], 0, 120) . "..."
                    );
                    ?>
    </div>
    <?php
            }
            ?>
</div>
<?php
    }
}