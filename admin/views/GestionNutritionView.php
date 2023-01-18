<?php
require_once('./controllers/GestionNutritionController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionNutritionView extends GlobalView
{
    public function content()
    {
        $controller = new GestionNutritionController();
        $ingredients = $controller->getAllIngredients();
        $this->ingredients($ingredients);
    }

    public function ingredients($ingredients){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Gestion des ingrédients
            <a href="./ajouter-ingredient" class="action-btn" style="test-decoration:none">
                Ajouter un ingrédient
            </a>
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">nom de l'ingrédient</th>
                        <th data-sortable="true">saison naturelle</th>
                        <th data-sortable="true">healthy</th>
                        <th data-sortable="true">proportion healthy</th>
                        <th data-sortable="true">calories</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($ingredients as $ingredient){
                        ?>
                    <tr>
                        <td><?php echo $ingredient["nomIngredient"] ?></td>
                        <td><?php echo $ingredient["saisonNaturelle"] ?></td>
                        <td><?php if ($ingredient["healthy"] == 1) {
                            echo "oui";}else{echo "non";} ?></td>
                        <td><?php echo $ingredient["proportionHealthy"] ?></td>
                        <td><?php if ($ingredient["calories"] != NULL) {
                            echo $ingredient["calories"] . " par 100 grams";}else{
                            echo $ingredient["calories"];
                            } ?></td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <a href="<?php echo "./modifier-ingredient?idIngredient=".$ingredient["idIngredient"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="modifier ingredient">
                                    <i class="fa-solid fa-pen-to-square color m-auto"></i>
                                </a>
                                <!-- lazm tne7ih mn se compose tani f suppression -->
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idIngredient"
                                        value="<?php echo $ingredient["idIngredient"] ?>">
                                    <button type="submit" name="supprimer-ingredient" class="btn-d-none"
                                        data-toggle="tooltip" data-placement="bottom" title="supprimer ingredient">
                                        <i class="fa-solid fa-trash color m-auto"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
    }
    public function afficherGestionNutrition()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}