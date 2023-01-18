<?php
require_once('./controllers/ParametresController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class ParametresView extends GlobalView
{
    public function content()
    {
        $controller = new ParametresController();
        $diapo = $controller->getDiapo();
        $this->parametres($diapo);
    }

    public function parametres($diapo){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Gestion de Diaporama
            <a href="./ajouter-diapo" class="action-btn" style="test-decoration:none">
                Ajouter un diapo
            </a>
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">image</th>
                        <th data-sortable="true">lien vers</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($diapo as $diapoItem){
                        ?>
                    <tr>
                        <td><img src="<?php echo $diapoItem["diapoImage"] ?>" alt="" height="100px" width="200px"
                                style="object-fit:cover"></td>
                        <td><?php echo $diapoItem["nomItem"]?></td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <a href="<?php echo "./modifier-diapo?idDiapo=".$diapoItem["idItem"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="modifier diapo">
                                    <i class="fa-solid fa-pen-to-square color m-auto"></i>
                                </a>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idItem" value="<?php echo $diapoItem["idItem"] ?>">
                                    <button type="submit" name="supprimer-diapo" class="btn-d-none"
                                        data-toggle="tooltip" data-placement="bottom" title="supprimer diapo">
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
    public function afficherParametres()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}