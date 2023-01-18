<?php
require_once "./controllers/PageLoginController.php";
require_once "./controllers/GestionRecettesController.php";
require_once "./controllers/PageAcceuilController.php";
require_once "./controllers/GestionRecettesController.php";
require_once "./controllers/GestionNewsController.php";
require_once "./controllers/GestionNutritionController.php";
require_once "./controllers/GestionUsersController.php";
require_once "./controllers/ParametresController.php";
require_once "./controllers/MessagesController.php";
session_start();
$request = $_SERVER['REQUEST_URI'];
if (isset($_GET['idRecette'])) {
    $idRecette = $_GET['idRecette'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idNews'])) {
    $idNews = $_GET['idNews'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idDiapo'])) {
    $idDiapo = $_GET['idDiapo'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idIngredient'])) {
    $idIngredient = $_GET['idIngredient'];
    $request = explode('?', $request)[0];
}
switch ($request) {
    case "/Projet_tdw/admin/":
        $controller = new PageLoginController();
        $controller->afficherPageLogin();
        break;
    case '/Projet_tdw/admin/login':
        $controller = new PageLoginController();
        $controller->afficherPageLogin();
        break;
    case '/Projet_tdw/admin/acceuil':
        $controller = new PageAccueilController();
        $controller->afficherPageAccueil();
        break;
    case '/Projet_tdw/admin/gestion-recettes':
        $controller = new GestionRecettesController();
        $controller->afficherGestionRecettes();
        break;
    case '/Projet_tdw/admin/ajouter-recette':
        $controller = new GestionRecettesController();
        $controller->afficherPageAjoutRecette();
        break;
    case '/Projet_tdw/admin/recette':
        $controller = new GestionRecettesController();
        $controller->afficherPageRecette($idRecette);
        break;
    case '/Projet_tdw/admin/modifier-recette':
        $controller = new GestionRecettesController();
        $controller->afficherModifierRecette($idRecette);
        break;
    case '/Projet_tdw/admin/gestion-news':
        $controller = new GestionNewsController();
        $controller->afficherGestionNews();
        break;
    case '/Projet_tdw/admin/news':
        $controller = new GestionNewsController();
        $controller->afficherPageNews($idNews);
        break;
    case '/Projet_tdw/admin/ajouter-news':
        $controller = new GestionNewsController();
        $controller->afficherPageAjoutNews();
        break;
    case '/Projet_tdw/admin/gestion-users':
        $controller = new GestionUsersController();
        $controller->afficherGestionUsers();
        break;
    case '/Projet_tdw/admin/gestion-nutrition':
        $controller = new GestionNutritionController();
        $controller->afficherGestionNutrition();
        break;
    case '/Projet_tdw/admin/parametres':
        $controller = new ParametresController();
        $controller->afficherParametres();
        break;
    case '/Projet_tdw/admin/profile':
        $controller = new GestionUsersController();
        $controller->afficherPageProfile($idUser);
        break;
    case '/Projet_tdw/admin/ajouter-diapo':
        $controller = new ParametresController();
        $controller->afficherPageAjoutDiapo();
        break;
    case '/Projet_tdw/admin/modifier-diapo':
        $controller = new ParametresController();
        $controller->afficherPageModifierDiapo($idDiapo);
        break;
    case '/Projet_tdw/admin/ajouter-ingredient':
        $controller = new GestionNutritionController();
        $controller->afficherPageAjoutIngredient();
        break;
    case '/Projet_tdw/admin/modifier-ingredient':
        $controller = new GestionNutritionController();
        $controller->afficherPageModifierIngredient($idIngredient);
        break;
    case '/Projet_tdw/admin/messages':
        $controller = new MessagesController();
        $controller->afficherMessages();
        break;
}