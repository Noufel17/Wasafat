<?php
require_once('./views/Components.php');
require_once('./controllers/PageNutritionController.php');
class PageNutritionView extends GlobalView
{
    public function content()
    {
        $components = new Components();
        $components->searchFilterHeader("Les differents ingredients", false);
        $controller = new PageNutritionController();
        $ingredients = $controller->getIngredients();
        $this->ingredients($ingredients);
    }
    public function ingredients($ingredients)
    {
?>
<div class="card-deck row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 m-auto" style="width:80%;">
    <?php
            $components = new Components();
            foreach ($ingredients as $ingredient) {
            ?>
    <div class="col">
        <?php
                    $components->cardIngredient(
                        $ingredient["idIngredient"],
                        $ingredient["nomIngredient"],
                        $ingredient["healthy"],
                        $ingredient["proportionHealthy"],
                        $ingredient["saisonNaturelle"],
                        $ingredient["calories"]
                    );
                    ?>
    </div>
    <?php
            }
            ?>
</div>
<?php
    }
    public function afficherPageNutrition()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}