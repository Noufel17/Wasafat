<?php
require_once('./views/PageAjoutNewsView.php');
require_once('./views/PageModifierNewsView.php');
require_once('./views/PageNewsView.php');
require_once('./views/GestionNewsView.php');
require_once('./models/GestionNewsModel.php');

class GestionNewsController
{
    public function getAllNews(){
        $model = new GestionNewsModel();
        return $model->getAllNews();
    }
    public function getNewsById($idNews)
    {
        $mode = new GestionNewsModel();
        return $mode->getNewsById($idNews);
    }
    public function supprimerNews()
    {
        $idNews = $_POST["idNews"];
        $model = new GestionNewsModel();
        $model->supprimerNews($idNews);
        header("Location: ./gestion-news");
    }
    public function modifierNews(){
        $idNews = $_POST["idNews"];
        $titre = $_POST["titre"];
        // modified paragraphs
        if(isset($_POST["paragraph"])){
            $paragraphs = $_POST["paragraph"];
        }
        $oldImages = $_POST["oldImages"];
        if(isset($_POST["addedParagraph"])){
            $addedParagraphs = $_POST["addedParagraph"];
        }
        if(isset($_FILES["coverImage"])){
            $coverImage = $_FILES["coverImage"];
        }
        if (isset($_FILES["addedNewsImages"])) {
            $newsImages = $_FILES["addedNewsImages"];
        }
        if (isset($_FILES["newsVideo"])) {
            $newsVideo = $_FILES["newsVideo"];
        }
        $names = array();
            $tmpnames = array();
            foreach($newsImages["name"] as $name){
                array_push($names, $name);
            }
            foreach($newsImages["tmp_name"] as $tmpname){
                array_push($tmpnames, $tmpname);
            }
        print_r($newsImages);
        $images = "";
        if($newsImages["error"][0]==0) { //not empty array
            for($i=0;$i<count($names);$i++){
                // echo $names[$i];
                // echo $tmpnames[$i];
                $r = explode(".",  $names[$i]);
                $imageName = $r[0];
                $imageExt = strtolower(end($r));
                $tmpImage = $tmpnames[$i];
                while (!is_uploaded_file($tmpImage)) {
                    // wait untill file is uploaded
                }
                if (in_array($imageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                    $imageDest = "../public/images/news/" . $names[$i];
                    move_uploaded_file($tmpImage, $imageDest);
                }
                $imageName = "/" . $imageName;
                if($i==count($names)-1){
                    $images = $images .$imageName;
                }else{
                    $images = $images .$imageName."," ;
                }
            }
            if($oldImages!=""){
                $images = $oldImages . "," . $images;
            }
        }else{
            $images = $oldImages;
        }
        if($coverImage["error"]==0){
            $r = explode(".", $coverImage["name"]);
            $newsImageName = $r[0];
            $newsImageExt = strtolower(end($r));
            $tmpImage = $coverImage["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($newsImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $imageDest = "../public/images/news/" . $coverImage["name"];
                move_uploaded_file($tmpImage, $imageDest);
            }
            $newsImageName = "/" . $newsImageName;
        }else{
            $newsImageName = NULL;
        }


        if($newsVideo["error"]==0){
            $r = explode(".", $newsVideo["name"]);
            $newsVideoName = $r[0];
            $newsVideoExt = strtolower(end($r));
            $tmpImage = $newsVideo["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($newsVideoExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $vidDest = "../public/videos/news/" . $newsVideo["name"];
                move_uploaded_file($tmpImage, $vidDest);
            }
            $newsVideoName = "/" . $newsVideoName;
           }else{
                $newsVideoName = NULL;
           }
        $corps = "";
        if($paragraphs[0]!=NULL){ // add paragraphs
            foreach($paragraphs as $paragraph){
                $corps = $corps . $paragraph . "$";
            }
        }
        if($addedParagraphs[0]!=NULL){ // add added paragraphs
            foreach($addedParagraphs as $addedParagraph){
                $corps = $corps . $addedParagraph . "$";
            }
        }
        $corps[strlen($corps)-1] = ' ';
        $model = new GestionNewsModel();
        $model->modifierNews(
            $idNews,$titre,$corps,$images,$newsImageName,$newsVideoName
        );
        header('Location: ./gestion-news');
    }
    public function ajouterNews(){
        $titre = $_POST["titre"];
        $paragraphs = $_POST["paragraph"];

        if(isset($_FILES["coverImage"])){
            $coverImage = $_FILES["coverImage"];
        }
        if (isset($_FILES["newsImages"])) {
            $newsImages = $_FILES["newsImages"];
        }
        if (isset($_FILES["newsVideo"])) {
            $newsVideo = $_FILES["newsVideo"];
        }
        $names = array();
        $tmpnames = array();
        foreach($newsImages["name"] as $name){
            array_push($names, $name);
        }
        foreach($newsImages["tmp_name"] as $tmpname){
            array_push($tmpnames, $tmpname);
        }
        // print_r($tmpnames);
        $images = "";
        if($newsImages["error"][0]==0) { //not empty array
            for($i=0;$i<count($names);$i++){
                // echo $names[$i];
                // echo $tmpnames[$i];
                $r = explode(".",  $names[$i]);
                $imageName = $r[0];
                $imageExt = strtolower(end($r));
                $tmpImage = $tmpnames[$i];
                while (!is_uploaded_file($tmpImage)) {
                    // wait untill file is uploaded
                }
                if (in_array($imageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                    $imageDest = "../public/images/news/" . $names[$i];
                    move_uploaded_file($tmpImage, $imageDest);
                }
                $imageName = "/" . $imageName;
                if($i==count($names)-1){
                    $images = $images .$imageName;
                }else{
                    $images = $images .$imageName."," ;
                }
            }
        }else{
            $images = NULL;
        }
        $r = explode(".", $coverImage["name"]);
        $newsImageName = $r[0];
        $newsImageExt = strtolower(end($r));
        $tmpImage = $coverImage["tmp_name"];
        while (!is_uploaded_file($tmpImage)) {
            // wait untill file is uploaded
        }
        if (in_array($newsImageExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
            $imageDest = "../public/images/news/" . $coverImage["name"];
            move_uploaded_file($tmpImage, $imageDest);
        }
        $newsImageName = "/" . $newsImageName;


        if($newsVideo["error"]==0){
            $r = explode(".", $newsVideo["name"]);
            $newsVideoName = $r[0];
            $newsVideoExt = strtolower(end($r));
            $tmpImage = $newsVideo["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($newsVideoExt, array('jpg', 'jpeg', 'png', 'mp4'))) {
                $vidDest = "../public/videos/news/" . $newsVideo["name"];
                move_uploaded_file($tmpImage, $vidDest);
            }
            $newsVideoName = "/" . $newsVideoName;
           }else{
                $newsVideoName = NULL;
           }
        $corps = "";
        foreach($paragraphs as $paragraph){
            $corps = $corps . $paragraph . "$";
        }
        $corps[strlen($corps)-1] = ' ';
        $model = new GestionNewsModel();
        $model->ajouterNews(
            $titre,$corps,$images,$newsImageName,$newsVideoName
        );
        header('Location: ./gestion-news');
        
    }
    public function afficherGestionNews(){
        $view = new GestionNewsView();
        $view->afficherGestionNews();
    }
    public function afficherPageAjoutNews(){
        $view = new PageAjoutNewsView();
        $view->afficherPageAjoutNews();
    }
    public function afficherPageNews($idNews){
        $view = new PageNewsView();
        $view->afficherPageNews($idNews);
    }
    public function afficherPageModifierNews($idNews){
        $view = new PageModifierNewsView();
        $view->afficherPageModifierNews($idNews);
    }
}