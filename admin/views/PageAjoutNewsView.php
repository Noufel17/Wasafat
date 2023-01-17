<?php
require_once('./views/Components.php');
require_once('./controllers/GestionRecettesController.php');
require_once('./views/GlobalView.php');
class PageAjoutNewsView extends GlobalView
{
    public function content()
    {
?>
<div class="container d-flex align-items-center justify-content-center">
    <div class="col d-flex justify-content-center align-items-center font">
        <form action="./redirect.php" method="POST" id="ajout-news-form" enctype="multipart/form-data"
            class=" radius-20 shadow d-flex flex-column gap-4 p-4">
            <center>
                <a href="./gestion-news" class="action-btn" style="text-decoration:none;">retour</a>
            </center>
            <div class="form-group w-100">
                <label for="titre">Titre </label>
                <input type="text" required class="form-control" id="titre" name="titre" placeholder="Titre de news">
            </div>
            <div class="form-group mb-3">
                <label for="coverImage" class="form-label">Image de couverture</label>
                <input class="form-control" type="file" id="coverImage" name="coverImage" required>
            </div>
            <div class="card">
                <div class="card-header">
                    Ajouter des images a la news
                </div>
                <div id="images" class="card-body">
                    <div class="form-group mb-3 row row-cols-2 align-items-center">
                        <div class="col md-cols-8">
                            <input class="form-control" type="file" id="newsImage" name="newsImages[]">
                        </div>
                        <div class="col md-cols-4">
                            <button type="button" class="btn btn-success add-img-btn">
                                Ajouter une image
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="newsVideo" class="form-label">Vidéo de la recette</label>
                <input class="form-control" type="file" id="newsVideo" name="newsVideo">
            </div>
            <div class="card">
                <div class="card-header">
                    Paragraphs
                </div>
                <div class="card-body" id="para">
                    <div class="col-md-12 mb-3">
                        <textarea name="paragraph[]" class="form-control" style="height:200px" required
                            placeholder="Paragraph"></textarea>
                        <button type="button" class="btn btn-success add-para-btn mt-2">
                            Ajouter un paragraph
                        </button>
                    </div>
                </div>
            </div>
            <center> <button type="submit" class="action-btn" name="ajouter-news">Ajouter la news</button></center>
        </form>
    </div>
</div>
<?php
    }
    public function afficherPageAjoutNews()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}