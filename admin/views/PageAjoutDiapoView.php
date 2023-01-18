<?php
require_once('./views/Components.php');
require_once('./controllers/GestionRecettesController.php');
require_once('./controllers/GestionNewsController.php');
require_once('./controllers/ParametresController.php');
require_once('./views/GlobalView.php');
class PageAjoutDiapoView extends GlobalView
{
    public function content()
    {
        $controller = new GestionRecettesController();
        $recettes = $controller->getAllRecettes();
        $controller2 = new GestionNewsController();
        $news = $controller2->getAllNews();

?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-diapo-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./gestion-news" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <div class="form-group mb-3">
                <label for="coverImage" class="form-label">Image de diapo</label>
                <input class="form-control" type="file" id="diapoImage" name="diapoImage" required>
            </div>
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
            <div class="card" id="recette">
                <div class="card-header">
                    Choisissez une recette
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <select name="recette" class="form-control" required>
                            <option value="0" selected>choisir recette</option>
                            <?php
                            foreach($recettes as $recette){
                                
                                ?>
                            <option value="<?php echo $recette["idRecette"] ?>"><?php 
                            echo $recette["nomRecette"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card  d-none" id="news">
                <div class="card-header">
                    Choisissez une news
                </div>
                <div class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <select name="news" class="form-control" required>
                            <option value="0" selected>choisir news</option>
                            <?php
                            foreach($news as $new){
                                
                                ?>
                            <option value="<?php echo $new["idNews"] ?>"><?php 
                            echo $new["titre"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <center> <button type="submit" class="action-btn" name="ajouter-diapo">Ajouter le diapo</button></center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageAjoutDiapo()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}