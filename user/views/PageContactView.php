<?php
require_once("./controllers/PageContactController.php");
class PageContactView extends GlobalView
{
    public function content()
    {
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            Contacter Nous
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-lg-2 h-100 justify-content-center gap-5 align-items-center">
                <div class="col d-flex  flex-column justify-content-center align-items-center font"
                    style="max-width:400px">
                    <div class="d-flex flex-column justify-content-evenly align-items-start font ">
                        <div style="margin-bottom:48px">
                            <h2>Informations du contact</h2>
                            <span style="font-weight:normal;margin-bottom:32px">Vous pouvez nous envoyer un message et
                                notre
                                équipe va vous
                                répondre au bout de 24 heurs
                            </span>
                        </div>
                        <div>
                            <div class="d-flex flex-row justify-content-start gap-2 my-2">
                                <img src="../public/icons/phone" alt="" height="24px" width="24px">

                                <p>0549741711</p>
                            </div>
                            <div class="d-flex flex-row justify-content-start gap-2 my-2">
                                <img src="../public/icons/mail" alt="" height="24px" width="24px">
                                <p>jn_naili@esi.dz</p>
                            </div>
                            <div class="d-flex flex-row justify-content-start gap-2 my-2">
                                <img src="../public/icons/address" alt="" height="24px" width="24px">
                                <p>Cité universitaire Bouraoui Ammar</p>
                            </div>
                        </div>
                        <div style="margin-top:48px">
                            <center>
                                <div class="social">
                                    <?php
                                            $controller = new PageAccueilController();
                                            $rs = $controller->getReseauxSociaux();
                                            foreach ($rs as $reseau) {
                                            ?>
                                    <div>
                                        <a href="<?php echo $reseau["lienReseau"] ?>">
                                            <img src="<?php echo "../public/images" . $reseau["imageReseau"] ?>"
                                                width="24px" height="24px" />
                                        </a>
                                    </div>
                                    <?php
                                            }
                                            ?>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <form action="./redirect.php" method="POST"
                    class=" radius-20 shadow d-flex flex-column justify-content-center align-items-center gap-4 p-4">
                    <div class="form-row row row-cols-1 row-cols-md-2 w-100">
                        <div class="form-group col" style="padding-left:0 !important">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom"
                                required>
                        </div>
                        <div class="form-group col" style="padding-right:0 !important">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom"
                                required>
                        </div>
                    </div>
                    <div class="form-row row row-cols-1 row-cols-md-2 w-100">
                        <div class="form-group col" style="padding-left:0 !important">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="email@example.com" required>
                        </div>
                        <div class="form-group col" style="padding-right:0 !important">
                            <label for=" phone">Téléphone</label>
                            <input type="phone" class="form-control" id="phone" name="telephone"
                                placeholder="Votre numéro de Téléphone" required>
                        </div>
                    </div>
                    <div class="form-row row row-cols-1 w-100">
                        <textarea name="message" class="form-control" style="height:200px" required
                            placeholder="Ecrivez votre message ici"></textarea>
                    </div>
                    <button type="submit" class="action-btn" name="contact">Déposer message</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
    public function afficherPageContact()
    {
        $this->head();
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }
}