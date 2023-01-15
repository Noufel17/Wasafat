<?php
require_once('./views/GlobalView.php');
class PageRegisterView extends GlobalView
{
    public function content()
    {
?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 h-100 justify-content-center align-items-center">
        <div class="col d-flex justify-content-center align-items-center font" style="max-width:400px">
            <form action="./redirect.php" method="post"
                class=" radius-20 shadow d-flex flex-column justify-content-center align-items-center gap-4 p-4">
                <div class="form-row row row-cols-1 row-cols-md-2">
                    <div class="form-group col">
                        <label for="nom">Nom</label>
                        <input type="text" required class="form-control" id="nom" name="nom" placeholder="Nom">
                    </div>
                    <div class="form-group col">
                        <label for="prenom">Prénom</label>
                        <input type="text" required class="form-control" id="prenom" name="prenom" placeholder="Prenom">
                    </div>
                </div>
                <div class="form-group w-100">
                    <label for="email">Email</label>
                    <input type="email" required class="form-control" id="email" name="email"
                        placeholder="exemple@gmail.com">
                </div>
                <div class="form-group w-100">
                    <label for="ddn">Date de naissance</label>
                    <input type="date" required class="form-control" id="ddn" name="dateNaissance">
                </div>
                <div class="form-group w-100">

                    <label for="inputState">Sexe</label>
                    <select name="sexe" id="sexe" name="sexe" class="form-control" required>
                        <option selected>Choose...</option>
                        <option value="masculin">Masculin</option>
                        <option value="femenin">Femenin</option>
                    </select>

                </div>
                <div class="form-group w-100">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe"
                        required>
                </div>
                <button type="submit" class="action-btn" name="register">Créer Compte</button>
            </form>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
            <img src="./public/images/logo" alt="" class="img-fluid">
        </div>
    </div>

</div>

<?php
    }
    public function afficherPageRegister()
    {
        $this->head();
        $this->content();
    }
}