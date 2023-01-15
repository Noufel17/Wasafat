<?php
require_once("./controllers/PageRegisterController.php");
require_once("./controllers/PageLoginController.php");
require_once("./controllers/PageRecetteController.php");
require_once("./controllers/PageAjoutRecetteController.php");
require_once("./controllers/PageModifierProfileController.php");
require_once("./controllers/PageContactController.php");

if (isset($_POST['login'])) {
    $controller = new PageLoginController();
    $controller->handleLogin();
}
if (isset($_POST['logout'])) {
    $controller = new PageLoginController();
    $controller->handleLogout();
}
if (isset($_POST['register'])) {
    $controller = new PageRegisterController();
    $controller->handleRegister();
}
if (isset($_POST['notation'])) {
    echo 1;
    $controller = new PageRecetteController();
    $controller->handleNotation();
}
if (isset($_POST['favories'])) {
    $controller = new PageRecetteController();
    $controller->handleAjoutFavories();
}
if (isset($_POST['remove-favorie'])) {
    $controller = new PageRecetteController();
    $controller->handleRemoveFavories();
}
if (isset($_POST['ajout-recette'])) {
    $controller = new PageAjoutRecetteController();
    $controller->ajouterRecette();
}
if (isset($_POST['modifier-user'])) {
    $controller = new PageModifierProfileController();
    $controller->modifierProfile();
}
if (isset($_POST['contact'])) {
    $controller = new PageContactController();
    $controller->insererContact();
}