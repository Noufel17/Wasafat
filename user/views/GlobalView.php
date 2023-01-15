<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/controllers/PageAcceuilController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/views/Components.php');
class GlobalView
{
    public function head()
    {
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link defer rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
    <link defer rel="stylesheet" type="text/css" href="./index.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script defer src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js">
    </script>
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./jquery.js"></script>
    <link rel="icon" href="../public/images/wasafat-logo">
    <title>projet_TDW</title>
</head>
<?php
    }
    public function header()
    {
    ?>
<div class="header-container">
    <div class="logo">
        <img src="../public/images/logo" alt="" width="80px">
    </div>
    <div class="social-signin">
        <div class="social">
            <?php
                    $controller = new PageAccueilController();
                    $rs = $controller->getReseauxSociaux();
                    foreach ($rs as $reseau) {
                    ?>
            <div>
                <a href="<?php echo $reseau["lienReseau"] ?>">
                    <img src="<?php echo "../public/images" . $reseau["imageReseau"] ?>" width="32px" height="32px" />
                </a>
            </div>
            <?php
                    }
                    ?>
        </div>
        <?php
                if (!isset($_SESSION["user"])) {
                ?>
        <div class="signin">
            <a class="action-btn" style="text-decoration:none;font-weight:normal" href="/Projet_tdw/user/login">
                Se connecter
            </a>
        </div>
        <?php
                }
                ?>
        <?php
                if (isset($_SESSION["user"])) {
                ?>
        <div>
            <h3 style="margin:0">Connecté en tant que :<b> <?php echo $_SESSION["user"]["prenom"] ?> </b></h3>
        </div>
        <div>
            <a class="action-btn" style="text-decoration:none; font-weight:normal"
                href="<?php echo "/Projet_tdw/user/profile?idUser=" . $_SESSION["user"]["idUtilisateur"] ?>">
                Profile
            </a>
        </div>

        <?php
                }
                ?>

    </div>
</div>


<?php
    }
    public function menu()
    {
    ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2">
                <?php
                        $controller = new PageAccueilController();
                        $menu = $controller->getMenu();
                        foreach ($menu as $menuItem) {
                        ?>
                <li class="nav-item">
                    <a href="<?php echo "/Projet_tdw/user" . $menuItem["lienMenu"] ?>" class="nav-link">
                        <?php echo $menuItem["nomItem"] ?>
                    </a>
                </li>
                <?php
                        }
                        ?>
            </ul>
        </div>
    </div>
</nav>
<?php
    }

    function footer()
    {
    ?>
<div class="footer">
    <center>
        <div class="contact mx-auto">
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
    </center>
    <center>
        <ul class="footer-menu">
            <?php
                    $controller = new PageAccueilController();
                    $menu = $controller->getMenu();
                    foreach ($menu as $menuItem) {
                    ?>
            <li>
                <a href="<?php echo "/Projet_tdw/user" . $menuItem["lienMenu"] ?>">
                    <?php echo $menuItem["nomItem"] ?>
                </a>

            </li>

            <?php
                    }
                    ?>
        </ul>

    </center>
    <center class="d-flex flex-row justify-content-start align-items-center gap-4">
        <p>Tout les droits réservés Wasafat</p>
        <div class="social">
            <?php
                    $controller = new PageAccueilController();
                    $rs = $controller->getReseauxSociaux();
                    foreach ($rs as $reseau) {
                    ?>
            <div>
                <a href="<?php echo $reseau["lienReseau"] ?>">
                    <img src="<?php echo "../public/images" . $reseau["imageWhite"] ?>" width="24px" height="24px" />
                </a>
            </div>
            <?php
                    }
                    ?>
        </div>
    </center>

</div>

<?php
    }
}