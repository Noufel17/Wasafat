<?php
require_once('./views/Components.php');
class PageNewsView extends GlobalView
{
    public function content()
    {
        $components = new Components();
        $components->searchFilterHeader("News", false);
        $controller = new PageNewsController();
        $news = $controller->getNews();
        $this->news($news);
    }

    // Columns will be created dynamically once we integrate and the data shall be passed to the component
    public function news($news)
    {
?>
<div class="card-deck row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 m-auto" style="width:80%;">
    <?php
            $components = new Components();
            foreach ($news as $new) {
            ?>
    <div class="col">
        <?php
                    $components->cardNews(
                        $new["idNews"],
                        $new["coverImage"],
                        $new["titre"],
                        substr($new["corps"], 0, 120) . "..."
                    );
                    ?>
    </div>
    <?php
            }
            ?>
</div>
<?php
    }
    public function afficherPageNews()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}