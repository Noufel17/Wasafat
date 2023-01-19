<?php
require_once "./controllers/PageAcceuilController.php";
require_once "./controllers/PageCategoryController.php";
require_once "./controllers/PageRecetteController.php";
require_once "./controllers/PageNewsController.php";
require_once "./controllers/PageNewsDetailsController.php";
require_once "./controllers/PageHealthyController.php";
require_once "./controllers/PageFeteController.php";
require_once "./controllers/PageSaisonController.php";
require_once "./controllers/PageNutritionController.php";
require_once "./controllers/PageLoginController.php";
require_once "./controllers/PageRegisterController.php";
require_once "./controllers/PageProfileController.php";
require_once "./controllers/PageAjoutRecetteController.php";
require_once "./controllers/PageIdeeRecetteController.php";
require_once "./controllers/PageModifierProfileController.php";
require_once "./controllers/PageContactController.php";
session_start();
$request = $_SERVER['REQUEST_URI'];

if (isset($_GET['idCategory'])) {
    $idCategory = $_GET['idCategory'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idRecette'])) {
    $idRecette = $_GET['idRecette'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idNews'])) {
    $idNews = $_GET['idNews'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idIngredient'])) {
    $idIngredient = $_GET['idIngredient'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $request = explode('?', $request)[0];
}
if (isset($_GET['idFete'])) {
    $request = explode('?', $request)[0];
}
if (isset($_GET['idee-filter'])) {
    if (isset($_GET['idCategory'])) {
        $idCategory = $_GET['idCategory'];
    }
    $request = explode('?', $request)[0];
}
if (isset($_GET['failed'])) {
    $failed = $_GET['failed'];
    $request = explode('?', $request)[0];
}else{
    $failed = 0;
}
switch ($request) {
    case "/Projet_tdw/user/":
        $controller = new PageAccueilController();
        $controller->afficherPageAccueil();
        break;
    case '/Projet_tdw/user/acceuil':
        $controller = new PageAccueilController();
        $controller->afficherPageAccueil();
        break;
    case '/Projet_tdw/user/category':
        $controller = new PageCategoryController();
        $controller->afficherPageCategory($idCategory);
        break;
    case '/Projet_tdw/user/ideeRecette':
        $controller = new PageIdeeRecetteController();
        $controller->afficherPageIdeeRecette();
        break;
    case '/Projet_tdw/user/recette':
        $controller = new PageRecetteController();
        $controller->afficherPageRecette($idRecette);
        break;
    case '/Projet_tdw/user/news':
        $controller = new PageNewsController();
        $controller->afficherPageNews();
        break;
    case '/Projet_tdw/user/news-details':
        $controller = new PageNewsDetailsController();
        $controller->afficherPageNewsDetails($idNews);
        break;
    case '/Projet_tdw/user/healthy':
        $controller = new PageHealthyController();
        $controller->afficherPageHealthy();
        break;
    case '/Projet_tdw/user/fete':
        $controller = new PageFeteController();
        $controller->afficherPageFete();
        break;
    case '/Projet_tdw/user/saison':
        $controller = new PageSaisonController();
        $controller->afficherPageSaison();
        break;
    case '/Projet_tdw/user/nutrition':
        $controller = new PageNutritionController();
        $controller->afficherPageNutrition();
        break;
    case '/Projet_tdw/user/login':
        $controller = new PageLoginController();
        $controller->afficherPageLogin($failed);
        break;
    case '/Projet_tdw/user/register':
        $controller = new PageRegisterController();
        $controller->afficherPageRegister();
        break;
    case '/Projet_tdw/user/profile':
        $controller = new PageProfileController();
        $controller->afficherPageProfile($idUser);
        break;
    case '/Projet_tdw/user/ajouter-recette':
        $controller = new PageAjoutRecetteController();
        $controller->afficherPageAjoutRecette();
        break;
    case '/Projet_tdw/user/modifier-profile':
        $controller = new PageModifierProfileController();
        $controller->afficherPageModifierProfile();
        break;
    case '/Projet_tdw/user/contact':
        $controller = new PageContactController();
        $controller->afficherPageContact();
        break;
}