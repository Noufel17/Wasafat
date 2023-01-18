<?php
require_once('./models/DBconnection.php');
class GestionNewsModel extends DBconnection
{
    public function getAllNews(){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM news";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getNewsById($idNews)
    {
        try{
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $qry = "SELECT * FROM news WHERE idNews=:id";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idNews]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }   
    }
    public function supprimerNews($idNews){
        try{
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "DELETE FROM news WHERE idNews=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(['id' => $idNews]);
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }   
    }
    public function ajouterNews(
        $titre,$corps,$images,$newsImageName,$newsVideoName
    ){
        try{
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "INSERT INTO news (titre,corps,images,coverImage,video) 
                VALUES (:titre,:corps,:images,:newsImageName,:newsVideoName) ";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                'titre' => $titre,
                'corps'=>$corps,
                'images'=>$images,
                'newsImageName'=>$newsImageName,
                'newsVideoName'=>$newsVideoName
            ]);
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function modifierNews(
        $idNews,$titre,$corps,$images,$newsImageName,$newsVideoName
    ){
        try{
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            if($newsImageName != NULL && $newsVideoName != NULL){
                $qry = "UPDATE news SET titre=:titre,corps=:corps,images=:images,coverImage=:newsImageName,video=:newsVideoName 
                WHERE idNews =:idNews";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    'titre' => $titre,
                    'corps'=>$corps,
                    'images'=>$images,
                    'newsImageName'=>$newsImageName,
                    'newsVideoName'=>$newsVideoName,
                    'idNews'=>$idNews
                ]); 
            }
            if($newsImageName == NULL && $newsVideoName != NULL){
                $qry = "UPDATE news SET titre=:titre,corps=:corps,images=:images,video=:newsVideoName 
                WHERE idNews =:idNews";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    'titre' => $titre,
                    'corps'=>$corps,
                    'images'=>$images,
                    'newsVideoName'=>$newsVideoName,
                    'idNews'=>$idNews
                ]);  
            }
            if($newsImageName != NULL && $newsVideoName == NULL){
                $qry = "UPDATE news SET titre=:titre,corps=:corps,images=:images,coverImage=:newsImageName 
                WHERE idNews =:idNews";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    'titre' => $titre,
                    'corps'=>$corps,
                    'images'=>$images,
                    'newsImageName'=>$newsImageName,
                    'idNews'=>$idNews
                ]); 
            }
            if($newsImageName == NULL && $newsVideoName == NULL){
                $qry = "UPDATE news SET titre=:titre,corps=:corps,images=:images
                WHERE idNews =:idNews";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    'titre' => $titre,
                    'corps'=>$corps,
                    'images'=>$images,
                    'idNews'=>$idNews
                ]); 
            }
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}