<?php
require_once('./views/ParametresView.php');
require_once('./views/PageAjoutDiapoView.php');
require_once('./views/PageModifierDiapoView.php');
require_once('./models/ParametresModel.php');
require_once('./controllers/GestionRecettesController.php');
require_once('./controllers/GestionNewsController.php');

class ParametresController
{
    public function getDiapo(){
        $model = new ParametresModel();
        return $model->getDiapo();
    }
    public function afficherParametres(){
        $view = new ParametresView();
        $view->afficherParametres();
    }
    public function afficherPageAjoutDiapo(){
        $view = new PageAjoutDiapoView();
        $view->afficherPageAjoutDiapo();
    }
    public function afficherPageModifierDiapo($idDiapo){
        $view = new PageModifierDiapoView();
        $view->afficherPageModifierDiapo($idDiapo);
    }
    
    public function ajouterDiapo(){
        if($_POST["recette"]!=0){
            $id = $_POST["recette"];
            $controller = new GestionRecettesController();
            $recette = $controller->getRecetteById($id);
            $nom = $recette["nomRecette"];
            $lien = "/recette?idRecette=".$recette["idRecette"];
            $diapoImage = $_FILES["diapoImage"];
            $r = explode(".", $diapoImage["name"]);
            $diapoImageName = $r[0];
            $diapoImageExt = strtolower(end($r));
            $tmpImage = $diapoImage["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($diapoImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $imageDest = "../public/images/recettes/" . $diapoImage["name"];
                move_uploaded_file($tmpImage, $imageDest);
            }
            $diapoImageName = "../public/images/recettes" . $diapoImageName;
        }else{
            $id = $_POST["news"];
            $controller = new GestionNewsController();
            $news = $controller->getNewsById($id);
            $nom = $news["titre"];
            $lien = "/news-details?idNews=".$news["idNews"];
            $diapoImage = $_FILES["diapoImage"];
            $r = explode(".", $diapoImage["name"]);
            $diapoImageName = $r[0];
            $diapoImageExt = strtolower(end($r));
            $tmpImage = $diapoImage["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($diapoImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $imageDest = "../public/images/recettes/" . $diapoImage["name"];
                move_uploaded_file($tmpImage, $imageDest);
            }
            $diapoImageName = "../public/images/news" . $diapoImageName;
        }
        $model = new ParametresModel();
        $model->ajouterDiapo($nom,$lien,$diapoImageName);
        header("Location: ./parametres");
    }
    public function modifierDiapo()
    {
        $idItem = $_POST["idItem"];
        if($_POST["recette"]!=0){
            $id = $_POST["recette"];
            $controller = new GestionRecettesController();
            $recette = $controller->getRecetteById($id);
            $nom = $recette["nomRecette"];
            $lien = "/recette?idRecette=".$recette["idRecette"];
            $diapoImage = $_FILES["diapoImage"];
            if($diapoImage["error"]==0){
                $r = explode(".", $diapoImage["name"]);
                $diapoImageName = $r[0];
                $diapoImageExt = strtolower(end($r));
                $tmpImage = $diapoImage["tmp_name"];
                while (!is_uploaded_file($tmpImage)) {
                    // wait untill file is uploaded
                }
                if (in_array($diapoImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                    $imageDest = "../public/images/recettes/" . $diapoImage["name"];
                    move_uploaded_file($tmpImage, $imageDest);
                }
                $diapoImageName = "../public/images/recettes/" . $diapoImageName;
            }else{
                $diapoImageName = NULL;
            }
        }else{
            $id = $_POST["news"];
            $controller = new GestionNewsController();
            $news = $controller->getNewsById($id);
            $nom = $news["titre"];
            $lien = "/news-details?idNews=".$news["idNews"];
            $diapoImage = $_FILES["diapoImage"];
            $r = explode(".", $diapoImage["name"]);
            $diapoImageName = $r[0];
            $diapoImageExt = strtolower(end($r));
            $tmpImage = $diapoImage["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($diapoImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $imageDest = "../public/images/recettes/" . $diapoImage["name"];
                move_uploaded_file($tmpImage, $imageDest);
            }
            $diapoImageName = NULL;
        }
        $model = new ParametresModel();
        $model->modifierDiapo($idItem,$nom,$lien,$diapoImageName);
        //header("Location: ./parametres");
    }
    public function getDiapoById($id){
        $model = new ParametresModel();
        return $model->getDiapoById($id);
    }
    public function supprimerDiapo(){
        $idItem = $_POST["idItem"];
        $model = new ParametresModel();
        $model->supprimerDiapo($idItem);
        header("Location: ./parametres");
    }
}