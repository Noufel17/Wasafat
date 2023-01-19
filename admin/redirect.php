<?php
require_once("./controllers/PageLoginController.php");
require_once("./controllers/GestionRecettesController.php");
require_once("./controllers/GestionNewsController.php");
require_once("./controllers/GestionUsersController.php");
require_once("./controllers/GestionNutritionController.php");
require_once("./controllers/ParametresController.php");

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
if (isset($_POST['ajouter-news'])) {
    $controller = new GestionNewsController();
    $controller->ajouterNews();
}
if (isset($_POST['modifier-recette'])) {
    $controller = new GestionRecettesController();
    $controller->modifierRecette();
}
if (isset($_POST['supprimer-recette'])) {
    $controller = new GestionRecettesController();
    $controller->supprimerRecette();
}
if (isset($_POST['supprimer-news'])) {
    $controller = new GestionNewsController();
    $controller->supprimerNews();
}
if (isset($_POST['modifier-news'])) {
    $controller = new GestionNewsController();
    $controller->modifierNews();
}
if (isset($_POST['valider-recette'])) {
    $controller = new GestionRecettesController();
    $controller->validerRecette();
}
if (isset($_POST['banner-user'])) {
    $controller = new GestionUsersController();
    $controller->bannerUser($idUser);
}
if (isset($_POST['valider-user'])) {
    $controller = new GestionUsersController();
    $controller->validerUser($idUser);
}
if (isset($_POST['ajouter-diapo'])) {
    $controller = new ParametresController();
    $controller->ajouterDiapo();
}
if (isset($_POST['supprimer-diapo'])) {
    $controller = new ParametresController();
    $controller->supprimerDiapo();
}
if (isset($_POST['modifier-diapo'])) {
    $controller = new ParametresController();
    $controller->modifierDiapo();
}
if (isset($_POST['ajout-ingredient'])) {
    $controller = new GestionNutritionController();
    $controller->ajouterIngredient();
}
if (isset($_POST['supprimer-ingredient'])) {
    $controller = new GestionNutritionController();
    $controller->supprimerIngredient();
}
if (isset($_POST['modifier-ingredient'])) {
    $controller = new GestionNutritionController();
    $controller->modifierIngredient();
}
if (isset($_POST['modifier-context'])) {
    $controller = new ParametresController();
    $controller->modifierContext();
}