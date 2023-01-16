<?php
require_once("./controllers/PageLoginController.php");
require_once("./controllers/GestionRecettesController.php");

if (isset($_POST['login'])) {
    $controller = new PageLoginController();
    $controller->handleLogin();
}
if (isset($_POST['logout'])) {
    $controller = new PageLoginController();
    $controller->handleLogout();
}
if (isset($_POST['ajout-recette'])) {
    $controller = new GestionRecettesController();
    $controller->ajouterRecette();
}
if (isset($_POST['modifier-recette'])) {
    $controller = new GestionRecettesController();
    $controller->modifierRecette();
}
if (isset($_POST['supprimer-recette'])) {
    $controller = new GestionRecettesController();
    $controller->supprimerRecette();
}
if (isset($_POST['valider-recette'])) {
    $controller = new GestionRecettesController();
    $controller->validerRecette();
}