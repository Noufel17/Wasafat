<?php
require_once('./views/PageAjoutRecetteView.php');
require_once('./views/PageRecetteView.php');
require_once('./views/GestionRecettesView.php');
require_once('./views/PageModifierRecetteView.php');
require_once('./models/GestionRecettesModel.php');

class GestionRecettesController
{
    public function getAllRecettes()
    {
        $model = new GestionRecettesModel();
        return $model->getAllRecettes();
    }
    public function supprimerRecette(){
        $idRecette = $_POST["idRecette"];
        $model = new GestionRecettesModel();
        $model->supprimerRecette($idRecette);
        header("Location: ./gestion-recettes");
    }
    public function validerRecette(){
        $idRecette = $_POST["idRecette"];
        $model = new GestionRecettesModel();
        $model->validerRecette($idRecette);
        header("Location: ./gestion-recettes");
    }

    public function modifierRecette(){
        $idRecette = $_POST["idRecette"];
        $nom = $_POST["nom"];
        $tcuiss = $_POST["tcuiss"];
        $tprepa = $_POST["tprepa"];
        $trepos = $_POST["trepos"];
        if (isset($_POST["healthy"])) {
            $healthy = 1;
        } else {
            $healthy = 0;
        }
        $difficulte = $_POST["difficulte"];
        $category = $_POST["category"];
        $descriptionRecette = $_POST["descriptionRecette"];
        $calories = $_POST["calories"];
        $idFete = $_POST["idFete"];
        if(isset($_POST["idIngredient"])){
            $idIngredient = $_POST["idIngredient"];
            $quantite = $_POST["quantite"];
            $unite = $_POST["unite"];
        }else{
            $idIngredient = NULL;
            $quantite = NULL;
            $unite = NULL;
        }
        if(isset($_POST["idEtape"])){
            $idEtape = $_POST["idEtape"];
            $numEtape = $_POST["numEtape"];
            $descriptionEtape = $_POST["descriptionEtape"];
        }
        else{
            $idEtape = NULL;
            $numEtape = NULL;
            $descriptionEtape = NULL;
        }
        $addedIdIngredient = $_POST["addedIdIngredient"];
        $addedQuantite = $_POST["addedQuantite"];
        $addedUnite = $_POST["addedUnite"];
        $addedNumEtape = $_POST["addedNumEtape"];
        $addedDescriptionEtape = $_POST["addedDescriptionEtape"];
        if(isset($_FILES["recetteImage"])){
            $recetteImage = $_FILES["recetteImage"];
        }
        if (isset($_FILES["recetteVideo"])) {
            $recetteVideo = $_FILES["recetteVideo"];
        }
        // echo $idRecette;
        // echo $nom;
        // echo $tcuiss;
        // echo $tprepa;
        // echo $trepos;
        // echo $healthy;
        // echo $difficulte;
        // echo $category;
        // echo $descriptionRecette;
        // echo $calories;
        // echo $idFete;
        //print_r($idIngredient);
        // print_r($quantite);
        // print_r($unite);
        // print_r($numEtape);
        // print_r($descriptionEtape);
        // print_r($recetteImage);
        // print_r($recetteVideo);

        // uploader le ficher de l'image
       if($recetteImage["error"]==0){
        $r = explode(".", $recetteImage["name"]);
        $recetteImageName = $r[0];
        $recetteImageExt = strtolower(end($r));
        $tmpImage = $recetteImage["tmp_name"];
        while (!is_uploaded_file($tmpImage)) {
            // wait untill file is uploaded
        }
        if (in_array($recetteImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
            $imageDest = "../public/images/recettes/" . $recetteImage["name"];
            move_uploaded_file($tmpImage, $imageDest);
        }
        $recetteImageName = "/" . $recetteImageName;
       }else{
            $recetteImageName = NULL;
       }    
        // uploader le ficher du video
        if ($recetteVideo["error"] == 0) {
            $v = explode(".", $recetteVideo["name"]);
            $recetteVideoName = $v[0];
            $recetteVideoExt = strtolower(end($v));
            $tmpVideo = $recetteVideo["tmp_name"];
            while (!is_uploaded_file($tmpVideo)) {
                // wait untill file is uploaded
            }
            if (in_array($recetteVideoExt, array('webm', 'avi', 'mp4'))) {
                $videoDest = "../public/videos/recettes/" . $recetteVideo["name"];
                move_uploaded_file($tmpVideo, $videoDest);
            }
            $recetteVideoName = "/" . $recetteVideoName;
        } else {
            $recetteVideoName = NULL;
        }
        if ($idFete == 0) {
            $idFete = NULL;
        }
        $model = new GestionRecettesModel();
        $model->modifierRecette(
            $idRecette,
            $nom,
            $tcuiss,
            $tprepa,
            $trepos,
            $healthy,
            $difficulte,
            $category,
            $descriptionRecette,
            $calories,
            $idFete,
            $idIngredient,
            $quantite,
            $unite,
            $idEtape,
            $numEtape,
            $descriptionEtape,
            $recetteImageName,
            $recetteVideoName,
            $addedIdIngredient,
            $addedQuantite,
            $addedUnite,
            $addedNumEtape,
            $addedDescriptionEtape
        );
        header("Location: ./gestion-recettes");
    }

    public function ajouterRecette()
    {
        $nom = $_POST["nom"];
        $tcuiss = $_POST["tcuiss"];
        $tprepa = $_POST["tprepa"];
        $trepos = $_POST["trepos"];
        if (isset($_POST["healthy"])) {
            $healthy = 1;
        } else {
            $healthy = 0;
        }
        $difficulte = $_POST["difficulte"];
        $category = $_POST["category"];
        $descriptionRecette = $_POST["descriptionRecette"];
        $calories = $_POST["calories"];
        $idFete = $_POST["idFete"];
        $idIngredient = $_POST["idIngredient"];
        $quantite = $_POST["quantite"];
        $unite = $_POST["unite"];
        $numEtape = $_POST["numEtape"];
        $descriptionEtape = $_POST["descriptionEtape"];
        $recetteImage = $_FILES["recetteImage"];
        if (isset($_FILES["recetteVideo"])) {
            $recetteVideo = $_FILES["recetteVideo"];
        }


        // uploader le ficher de l'image

        $r = explode(".", $recetteImage["name"]);
        $recetteImageName = $r[0];
        $recetteImageExt = strtolower(end($r));
        $tmpImage = $recetteImage["tmp_name"];
        while (!is_uploaded_file($tmpImage)) {
            // wait untill file is uploaded
        }
        if (in_array($recetteImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
            $imageDest = "../public/images/recettes/" . $recetteImage["name"];
            move_uploaded_file($tmpImage, $imageDest);
        }
        $recetteImageName = "/" . $recetteImageName;
        // uploader le ficher du video
        if ($recetteVideo["error"] == 0) {
            $v = explode(".", $recetteVideo["name"]);
            $recetteVideoName = $v[0];
            $recetteVideoExt = strtolower(end($v));
            $tmpVideo = $recetteVideo["tmp_name"];
            while (!is_uploaded_file($tmpVideo)) {
                // wait untill file is uploaded
            }
            if (in_array($recetteVideoExt, array('webm', 'avi', 'mp4'))) {
                $videoDest = "../public/videos/recettes/" . $recetteVideo["name"];
                echo $videoDest;
                move_uploaded_file($tmpVideo, $videoDest);
            }
            $recetteVideoName = "/" . $recetteVideoName;
        } else {
            $recetteVideoName = NULL;
        }
        if ($idFete == 0) {
            $idFete = NULL;
        }

        // echo $idUser;
        // echo $nom;
        // echo $tcuiss;
        // echo $tprepa;
        //echo $healthy;
        // echo $trepos;
        // echo $difficulte;
        // echo $category;
        // echo $descriptionRecette;
        // echo $calories;
        // echo $idFete;
        // echo $recetteImageName;
        // echo $recetteVideoName;
        $model = new GestionRecettesModel();
        $model->ajouterRecette(
            $nom,
            $tcuiss,
            $tprepa,
            $trepos,
            $healthy,
            $difficulte,
            $category,
            $descriptionRecette,
            $calories,
            $idFete,
            $idIngredient,
            $quantite,
            $unite,
            $numEtape,
            $descriptionEtape,
            $recetteImageName,
            $recetteVideoName
        );
        header("Location: ./gestion-recettes");
    }
    public function getIngredients()
    {
        $model = new GestionRecettesModel();
        return $model->getIngredients();
    }
    public function afficherGestionRecettes()
    {
        $view = new GestionRecettesView();
        $view->afficherGestionRecettes();
    }
    public function afficherPageAjoutRecette()
    {
        $view = new PageAjoutRecetteView();
        $view->afficherPageAjoutRecette();
    }
    public function getFetes()
    {
        $model = new GestionRecettesModel();
        return $model->getFetes();
    }
    public function getRecetteById($idRecette)
    {
        $model = new GestionRecettesModel();
        return $model->getRecetteById($idRecette);
    }
    public function getEtapesRecette($idRecette)
    {
        $model = new GestionRecettesModel();
        return $model->getEtapesRecette($idRecette);
    }
    public function getIngredientsRecette($idRecette)
    {
        $model = new GestionRecettesModel();
        return $model->getIngredientsRecette($idRecette);
    }
    public function afficherPageRecette($idRecette)
    {
        $view = new PageRecetteView();
        $view->afficherPageRecette($idRecette);
    }
    public function afficherModifierRecette($idRecette)
    {
        $view = new PageModifierRecetteView();
        $view->afficherModifierRecette($idRecette);
    }
}