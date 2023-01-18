<?php
require_once('./views/Components.php');
require_once('./controllers/GestionRecettesController.php');
require_once('./controllers/GestionNewsController.php');
require_once('./controllers/ParametresController.php');
require_once('./views/GlobalView.php');
class PageModifierDiapoView extends GlobalView
{
    public function content($idDiapo)
    {
        $controller = new GestionRecettesController();
        $recettes = $controller->getAllRecettes();
        $controller2 = new GestionNewsController();
        $news = $controller2->getAllNews();
        $controller3 = new ParametresModel();
        $diapo=$controller3->getDiapoById($idDiapo);
        $s = explode("?",$diapo["lienDiapo"]);
        $recette = 0;
        if($s[0]=="/recette"){
            $recette = 1;
        }
        $s = explode("=", $diapo["lienDiapo"]);
        $id = end($s);
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-diapo-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./parametres" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <div class="form-group mb-3">
                <label for="coverImage" class="form-label">Image de diapo</label>
                <input class="form-control" type="file" id="diapoImage" name="diapoImage" required>
            </div>
            <?php
                if($recette){
                    ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" value="recette" checked>
                <label class="form-check-label" for="recette">
                    Recette
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" value="news">
                <label class="form-check-label" for="news">
                    News
                </label>
            </div>
            <?php
                }else{
                    ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" value="recette">
                <label class="form-check-label" for="recette">
                    Recette
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" value="news" checked>
                <label class="form-check-label" for="news">
                    News
                </label>
            </div>
            <?php

                }
            ?>

            <div class="<?php if ($recette == 1) {
                echo "card";
            } else {
                echo "card d-none";}  ?>" id="recette">
                <div class="card-header">
                    Modifier la recette
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <select name="recette" class="form-control" required>
                            <?php
                            if($recette == 0){
                                ?>
                            <option value="0" selected>Choisir recette</option>
                            <?php
                            }
                            foreach($recettes as $r){
                                if($r["idRecette"]==$id && $recette == 1){
                                        ?>
                            <option value="<?php echo $r["idRecette"] ?>" selected><?php 
                                                echo $r["nomRecette"] ?></option>
                            <?php
                                    
                                }else{
                                    ?>
                            <option value="<?php echo $r["idRecette"] ?>"><?php 
                                    echo $r["nomRecette"] ?></option>
                            <?php
                                    }
                                }
                               
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="<?php if ($recette == 0) {
                echo "card";
            } else {
                echo "card d-none";}  ?>" id="news">
                <div class="card-header">
                    Modifier la news
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <select name="news" class="form-control" required>

                            <?php
                            if($recette == 1){
                                ?>
                            <option value="0" selected>Choisir news</option>
                            <?php
                            }
                            foreach($news as $new){
                                if($new["idNews"]==$id && $recette ==0){
                                        ?>
                            <option value="<?php echo $new["idNews"] ?>" selected><?php 
                            echo $new["titre"] ?></option>
                            <?php         
                                    
                            }else{
                            ?>
                            <option value="<?php echo $new["idNews"] ?>"><?php 
                                    echo $new["titre"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="idItem" value="<?php echo $idDiapo?>">
            <center> <button type="submit" class="action-btn" name="modifier-diapo">modifier le diapo</button></center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageModifierDiapo($idDiapo)
    {
        $this->head();
        $this->header();
        $this->content($idDiapo);
    }
}