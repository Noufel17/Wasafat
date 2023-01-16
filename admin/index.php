<?php
require_once "./controllers/PageLoginController.php";
require_once "./controllers/GestionRecettesController.php";
require_once "./controllers/PageAcceuilController.php";
require_once "./controllers/GestionRecettesController.php";
session_start();
$request = $_SERVER['REQUEST_URI'];
if (isset($_GET['idRecette'])) {
    $idRecette = $_GET['idRecette'];
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
}