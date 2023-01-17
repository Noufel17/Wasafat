<?php
require_once('./views/Components.php');
require_once('./controllers/GestionNewsController.php');
class PageNewsView extends GlobalView
{
    public function content($idNews)
    {
        $this->retour();
        $components = new Components();
        $controller = new GestionNewsController();
        $news = $controller->getNewsById($idNews);
        $corps = $news["corps"];
        $components->imageNews($news["coverImage"]);
        $this->corps($news["titre"], $corps, $news["images"]);
        if ($news["video"]) {
            $components->video($news["video"]);
        }
    }
    public function retour(){
        ?>
<center>
    <a href="./gestion-news" class="action-btn" style="text-decoration:none;">retour</a>
</center>
<?php
    }
    public function corps($titre, $corps, $images)
    {
?>
<div class="container" style="width:80%;">
    <h2 style="font-weight:bold;"><?php echo $titre ?></h2>
    <div class="d-flex flex-row justify-content-center align-items-center gap-4">
        <div>
            <?php
                    $corps = explode("$", $corps);
                    foreach ($corps as $paragraph) {
                    ?>
            <p><?php echo $paragraph ?></p>
            <br>
            <?php
                    }
                    ?>

        </div>

        <div class="row row-cols-1 gap-4">
            <?php
            if($images != NULL){
                $images = explode(",", $images);
                foreach ($images as $image) {
                ?>
            <div class="col">
                <div style="border-radius:20px;" class="overflow-hidden">
                    <img src="<?php echo "../public/images/news" . $image ?>" alt="" width="300px">
                </div>


            </div>
            <?php
                }
                ?>
            <?php
            }
            ?>

        </div>
    </div>

</div>
<?php

    }
    public function afficherPageNews($idNews)
    {
        $this->head();
        $this->header();
        $this->content($idNews);
    }
}