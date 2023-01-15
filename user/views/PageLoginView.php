<?php
class PageLoginView extends GlobalView
{
    public function content()
    {
?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 h-100">
        <div class="col d-flex justify-content-center align-items-center">
            <img src="../public/images/logo" alt="" class="img-fluid">
        </div>
        <div class="col d-flex justify-content-center align-items-center font">
            <form action="./redirect.php" method="post"
                class=" radius-20 shadow d-flex flex-column justify-content-center align-items-center gap-4 p-4">
                <h3>Login</h3>
                <div class="form-group" style="width:276px">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre email">
                </div>
                <div class="form-group" style="width:276px">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Entrer votre mot de passe">
                </div>
                <button type="submit" class="action-btn" name="login">Se connecter</button>
                <div>Pas du cempte?<a href=" /Projet_tdw/user/register">créer un cempte</a>
                </div>

            </form>
        </div>
    </div>

</div>

<?php
    }
    public function afficherPageLogin()
    {
        $this->head();
        $this->content();
    }
}