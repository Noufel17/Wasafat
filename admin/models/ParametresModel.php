<?php
require_once('./models/DBconnection.php');
class ParametresModel extends DBconnection
{
    public function getDiapo()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM diapoitem";
        $result = $this->requete($dataBase, $qry);
        $this->disconnect($dataBase);
        return $result;
    }
    public function ajouterDiapo($nom,$lien,$image){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "INSERT INTO diapoitem (diapoImage,lienDiapo,nomItem) 
            VALUES (:image,:lien,:nom)";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["nom"=>$nom,"lien"=>$lien,"image"=>$image]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function supprimerDiapo($idItem){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "DELETE FROM diapoitem WHERE idItem=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["id"=>$idItem]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getDiapoById($id){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM diapoitem WHERE idItem=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["id"=>$id]);
            $result = $stmt->fetch();
            return $result;
        }catch(Exception $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function modifierDiapo($idItem,$nom,$lien,$image){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            if($image !=NULL){
                $qry = "UPDATE diapoitem SET diapoImage=:image,lienDiapo=:lien,nomItem=:nom 
                WHERE idItem=:id";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute(["nom"=>$nom,"lien"=>$lien,"image"=>$image,"id"=>$idItem]);
            }
            if($image ==NULL){
                $qry = "UPDATE diapoitem SET lienDiapo=:lien,nomItem=:nom
                WHERE idItem=:id";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute(["nom"=>$nom,"lien"=>$lien,"id"=>$idItem]);
            }
            
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getContext(){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM context";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(Exception $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function modifierContext($saison,$pourcentage){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "UPDATE context SET saison=:saison, pourcentage=:pourcentage";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "saison"=>$saison,
                "pourcentage"=>$pourcentage
            ]);
        }catch(Exception $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}