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
        $context = $controller->getContext();
        $this->parametres($diapo,$context);
       
    }

    public function parametres($diapo,$context){
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
            <div class="card mt-4">
                <div class="card-header">
                    Modifier la saison actuelle et le pourcentage de idée recette
                </div>
                <div class="card-body w-50 mx-auto">
                    <form action="./redirect.php" method="POST" id="params-form"
                        class=" radius-20 shadow d-flex flex-column gap-4 p-4">
                        <div class="form-row d-flex flex-row align-items-center justify-content-center gap-4">
                            <div class="form-group col w-50" style="min-width:220px">
                                <label>Pourcetage idée recette</label>
                                <input type="number" step="0.01" class="form-control" name="pourcentage"
                                    value="<?php echo $context["pourcentage"] ?>">
                            </div>
                            <div class="form-group col w-50">
                                <label>Saison actuelle</label>
                                <select name="saison" class="form-control" required>
                                    <?php 
                    if($context["saison"]=="automne"){
                        ?>
                                    <option value="automne" selected>Automne</option>
                                    <option value="hiver">Hiver</option>
                                    <option value="ete">Eté</option>
                                    <option value="printemps">Printemps</option>
                                    <?php
                    }
                    if($context["saison"]=="hiver"){
                        ?>
                                    <option value="automne">Automne</option>
                                    <option value="hiver" selected>Hiver</option>
                                    <option value="ete">Eté</option>
                                    <option value="printemps">Printemps</option>
                                    <?php
                    }
                    if($context["saison"]=="ete"){
                        ?>
                                    <option value="automne">Automne</option>
                                    <option value="hiver">Hiver</option>
                                    <option value="ete" selected>Eté</option>
                                    <option value="printemps">Printemps</option>
                                    <option value="partout">Partout</option>
                                    <?php
                    }
                    if($context["saison"]=="printemps"){
                        ?>
                                    <option value="automne">Automne</option>
                                    <option value="hiver">Hiver</option>
                                    <option value="ete">Eté</option>
                                    <option value="printemps" selected>Printemps</option>
                                    <option value="partout">Partout</option>
                                    <?php
                    }
                     ?>
                                </select>
                            </div>
                        </div>

                        <center> <button type="submit" class="action-btn" name="modifier-context">Modifier</button>
                        </center>
                    </form>
                </div>
            </div>
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