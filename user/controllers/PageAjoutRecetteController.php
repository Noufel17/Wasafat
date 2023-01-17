<?php
require_once('./views/PageAjoutRecetteView.php');
require_once('./models/PageAjoutRecetteModel.php');

class PageAjoutRecetteController
{

    public function ajouterRecette()
    {
        $idUser = $_POST["idUser"];
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
        // print_r($idIngredient);
        // print_r($unite);
        // print_r($quantite);
        // print_r($numEtape);
        // print_r($descriptionEtape);
        // echo $recetteImageName;
        // echo $recetteVideoName;
        $model = new PageAjoutRecetteModel();
        $model->ajouterRecette(
            $idUser,
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
        header("Location: /Projet_tdw/user/profile?idUser=" . $idUser);
    }
    public function getIngredients()
    {
        $model = new PageAjoutRecetteModel();
        return $model->getIngredients();
    }
    public function afficherPageAjoutRecette()
    {
        $view = new PageAjoutRecetteView();
        $view->afficherPageAjoutRecette();
    }
    public function getFetes()
    {
        $model = new PageAjoutRecetteModel();
        return $model->getFetes();
    }
}