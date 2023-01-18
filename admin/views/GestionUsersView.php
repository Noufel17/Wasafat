<?php
require_once('./controllers/GestionUsersController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionUsersView extends GlobalView
{
    public function content()
    {
        $controller = new GestionUsersController();
        $users = $controller->getAllUsers();
        $this->users($users);
    }

    public function users($users){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Gestion des Utilisateurs
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">nom</th>
                        <th data-sortable="true">prenom</th>
                        <th data-sortable="true">email</th>
                        <th data-sortable="true">date de <br>naissance</th>
                        <th data-sortable="true">sexe</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($users as $user){
                        ?>
                    <tr>
                        <td><?php echo $user["nom"] ?></td>
                        <td><?php echo $user["prenom"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["dateNaissance"] ?></td>
                        <td><?php echo $user["sexe"] ?></td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <a href="<?php echo "./profile?idUser=".$user["idUtilisateur"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="voir détaills">
                                    <i class="fa-sharp fa-solid fa-eye color m-auto"></i>
                                </a>
                                <?php 
                                if($user["valide"]==0){
                                    ?>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idUser" value="<?php echo $user["idUtilisateur"] ?>">
                                    <button type="submit" name="valider-user" class="btn-d-none" data-toggle="tooltip"
                                        data-placement="bottom" title="valider inscription">
                                        <i class="fa-solid fa-check color m-auto"></i>
                                    </button>
                                </form>
                                <?php
                                }
                            ?>
                                <?php 
                                if($user["valide"]==1){
                                    ?>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idUser" value="<?php echo $user["idUtilisateur"] ?>">
                                    <button type="submit" name="banner-user" class="btn-d-none" data-toggle="tooltip"
                                        data-placement="bottom" title="banner utilisateur">
                                        <i class="fa-solid fa-ban color m-auto"></i>
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
    public function afficherGestionUsers()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}