<?php
require_once('./controllers/GestionRecettesController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionRecettesView extends GlobalView
{
    public function content()
    {
        $controller = new GestionRecettesController();
        $recettes = $controller->getAllRecettes();
        $this->recettes($recettes);
    }

    public function recettes($recettes){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Gestion des recettes
            <a href="./ajouter-recette" class="action-btn" style="test-decoration:none">
                Ajouter une recette
            </a>
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">nom de la recette</th>
                        <th data-sortable="true">temps de <br>préparation</th>
                        <th data-sortable="true">temps de <br>cuisson</th>
                        <th data-sortable="true">temps<br> total</th>
                        <th data-sortable="true">difficulté</th>
                        <th data-sortable="true">catégorie</th>
                        <th data-sortable="true">notation</th>
                        <th data-sortable="true">saison</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($recettes as $recette){
                        ?>
                    <tr>
                        <td><?php echo $recette["nomRecette"] ?></td>
                        <td><?php echo $recette["tempsPreparation"] . "min" ?></td>
                        <td><?php echo $recette["tempsCuission"] . "min" ?></td>
                        <td><?php echo $recette["tempsTotal"] . "min" ?></td>
                        <td><?php echo $recette["difficulte"] ?></td>
                        <td><?php echo $recette["categorie"] ?></td>
                        <td><?php if ($recette["notation"] != NULL) {
                            echo $recette["notation"] ."/5";
                        } else
                            echo "0/5";  ?></td>
                        <td><?php echo $recette["saisonNaturelle"] ?></td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <a href="<?php echo "./recette?idRecette=".$recette["idRecette"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="voir détaills">
                                    <i class="fa-sharp fa-solid fa-eye color m-auto"></i>
                                </a>
                                <a href="<?php echo "./modifier-recette?idRecette=".$recette["idRecette"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="modifier">
                                    <i class="fa-solid fa-pen-to-square color m-auto"></i>
                                </a>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idRecette" value="<?php echo $recette["idRecette"] ?>">
                                    <button type="submit" name="supprimer-recette" class="btn-d-none"
                                        data-toggle="tooltip" data-placement="bottom" title="supprimer recette">
                                        <i class="fa-solid fa-trash color m-auto"></i>
                                    </button>
                                </form>
                                <?php 
                                if($recette["etat"]==0){
                                    ?>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idRecette" value="<?php echo $recette["idRecette"] ?>">
                                    <button type="submit" name="valider-recette" class="btn-d-none"
                                        data-toggle="tooltip" data-placement="bottom" title="valider recette">
                                        <i class="fa-solid fa-check color m-auto"></i>
                                    </button>
                                </form>
                                <?php
                                }
                            ?>
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
    public function afficherGestionRecettes()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}