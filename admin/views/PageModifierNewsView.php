<?php
require_once('./views/Components.php');
require_once('./controllers/GestionNewsController.php');
require_once('./views/GlobalView.php');
class PageModifierNewsView extends GlobalView
{
    public function content($idNews)
    {
        $controller = new GestionNewsController();
        $news = $controller->getNewsById($idNews);
        $paras = explode("$",$news["corps"]);
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-news-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./gestion-news" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <input type="hidden" name="idNews" value="<?php echo $news["idNews"] ?>">
            <div class="form-group w-100">
                <label for="titre">Titre </label>
                <input type="text" required class="form-control" id="titre" name="titre" placeholder="Titre de news"
                    value="<?php echo $news["titre"] ?>">
            </div>
            <div class="form-group mb-3">
                <label for="coverImage" class="form-label">changer l'image de couverture</label>
                <input class="form-control" type="file" id="coverImage" name="coverImage">
            </div>
            <input type="hidden" name="oldImages" value="<?php echo $news["images"] ?>">
            <div class="card">
                <div class="card-header">
                    Ajouter des images à la news
                </div>
                <div id="added-images" class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <div class="col md-cols-8">
                            <input class="form-control" type="file" name="addedNewsImages[]">
                        </div>
                        <div class="col md-cols-4">
                            <button type="button" class="btn btn-success add-added-img-btn">
                                Ajouter une image
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="newsVideo" class="form-label">Vidéo de la news</label>
                <input class="form-control" type="file" id="newsVideo" name="newsVideo">
            </div>
            <div class="card">
                <div class="card-header">
                    Modifier les paragraphs
                </div>
                <?php 
                foreach($paras as $para){
                    ?>
                <div class="card-body" id="para">
                    <div class="col-md-12 mb-3">
                        <input type="text" name="paragraph[]" class="form-control" style="height:200px" required
                            placeholder="Paragraph" value="<?php echo $para ?>"></input>
                        <button type="button" class="btn btn-danger remove-para-btn mt-2">
                            Supprimer paragraph
                        </button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter des paragraphs
                </div>
                <div class="card-body" id="added-para">
                    <div class="col-md-12 mb-3">
                        <textarea name="addedParagraph[]" class="form-control" style="height:200px"
                            placeholder="Paragraph"></textarea>
                        <button type="button" class="btn btn-success add-added-para-btn mt-2">
                            Ajouter un paragraph
                        </button>
                    </div>
                </div>
            </div>
            <center> <button type="submit" class="action-btn" name="modifier-news">Modifier la news</button></center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageModifierNews($idNews)
    {
        $this->head();
        $this->header();
        $this->content($idNews);
    }
}