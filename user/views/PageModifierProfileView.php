<?php
require_once('./controllers/PageModifierProfileController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class PageModifierProfileView extends GlobalView
{
    public function content()
    {
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            Modifier votre profile
        </div>
        <div class="card-body">
            <a href="<?php echo "./profile?idUser=" . $_SESSION["user"]["idUtilisateur"] ?>" class="action-btn"
                style="text-decoration:none;">retourner</a>
            <div class="row row-cols-1 row-cols-lg-2 h-100 justify-content-center gap-5 align-items-center">
                <div class="col d-flex  flex-column justify-content-center align-items-center font"
                    style="max-width:400px">
                    <div class="col d-flex justify-content-center align-items-center">
                        <img src="<?php echo "../public/images/profile/" . $_SESSION["user"]["imageProfile"] ?>" alt=""
                            class="img-fluid round mx-auto">
                    </div>
                    <div class="mx-auto d-flex flex-column justify-content-center align-items-center"
                        style="margin-top:24px">
                        <div class="row row-cols-2">
                            <h2 style="width:fit-content"> <b> <?php echo $_SESSION["user"]["nom"] ?> </b></h2>
                            <h2 style="width:fit-content"> <b> <?php echo $_SESSION["user"]["prenom"] ?></b></h2>
                        </div>
                    </div>

                </div>

                <form action="./redirect.php" method="POST" enctype="multipart/form-data"
                    class=" radius-20 shadow d-flex flex-column justify-content-center align-items-center gap-4 p-4">
                    <input type="hidden" name="idUser" value="<?php echo $_SESSION["user"]["idUtilisateur"] ?>">
                    <input type="hidden" name="oldImage" value="<?php echo $_SESSION["user"]["imageProfile"] ?>">
                    <div class="form-row row row-cols-1 row-cols-md-2">
                        <div class="form-group col">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                value="<?php echo $_SESSION["user"]["nom"] ?>" required>
                        </div>
                        <div class="form-group col">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom"
                                value="<?php echo $_SESSION["user"]["prenom"] ?>" required>
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo $_SESSION["user"]["email"] ?>" required>
                    </div>
                    <div class="form-group w-100">
                        <label for="ddn">Date de naissance</label>
                        <input type="date" class="form-control" id="ddn" name="dateNaissance"
                            value="<?php echo $_SESSION["user"]["dateNaissance"] ?>" required>
                    </div>
                    <div class="form-group w-100">

                        <label for="inputState">Sexe</label>
                        <select name="sexe" id="sexe" name="sexe" class="form-control">
                            <option value="<?php echo $_SESSION["user"]["sexe"] ?>" selected>
                                <?php echo ucfirst($_SESSION["user"]["sexe"]) ?></option>
                            <?php
                                    if ($_SESSION["user"]["sexe"] == 'masculin') {
                                    ?>
                            <option value="femenin">Femenin</option>
                            <?php
                                    } else {
                                    ?>
                            <option value="masculin">Masculin</option>
                            <?php
                                    }
                                    ?>

                        </select>

                    </div>
                    <div class="form-group w-100">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="changer votre mot de passe">
                    </div>
                    <div class="form-group mb-3 w-100">
                        <label for="profileImage" class="form-label">Modifier votre image du profile</label>
                        <input class="form-control" type="file" id="profileImage" name="profileImage">
                    </div>
                    <button type="submit" class="action-btn" name="modifier-user">Modifier</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php
    }
    public function afficherPageModifierProfile()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}