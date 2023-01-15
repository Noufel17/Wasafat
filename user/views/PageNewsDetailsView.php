<?php
require_once('./views/Components.php');
class PageNewsDetailsView extends GlobalView
{
    public function content($idNews)
    {
        $components = new Components();
        $controller = new PageNewsDetailsController();
        $news = $controller->getNewsById($idNews);
        // coverImage de la news quand on le recupere de la base de donnees
        $corps = $news["corps"];
        $components->imageNews($news["coverImage"]);
        $this->corps($news["titre"], $corps, $news["images"]);
        if ($news["video"]) {
            $components->video($news["video"]);
        }
    }

    public function corps($titre, $corps, $images)
    {
?>
<div class="container" style="width:80%;">
    <h2 style="font-weight:bold;"><?php echo $titre ?></h2>
    <div class="d-flex flex-row gap-4">
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
        </div>
    </div>

</div>
<?php

    }
    public function afficherPageNewsDetails($idNews)
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content($idNews);
        $this->footer();
    }
}