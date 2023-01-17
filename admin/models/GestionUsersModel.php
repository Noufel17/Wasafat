<?php
require_once('./models/DBconnection.php');
class GestionUsersModel extends DBconnection
{
    public function getAllUsers(){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM utilisateur";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getUserById($idUser){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM utilisateur WHERE idUtilisateur=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["id"=>$idUser]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function validerUser($idUser)
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "UPDATE utilisateur SET valide=1 WHERE idUtilisateur=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["id"=>$idUser]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function bannerUser($idUser)
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "UPDATE utilisateur SET valide=0 WHERE idUtilisateur=:id";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["id"=>$idUser]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getRecettesByUser($idUser)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recettescrees rc JOIN recette r ON rc.idRecette = r.idRecette
         WHERE idUtilisateur = :idUser";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idUser' => $idUser]);
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
    public function getRecettesFavories($idUser)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recettesfavories rf JOIN recette r ON rf.idRecette=r.idRecette
         WHERE idUtilisateur=:idUser";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idUser' => $idUser]);
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
}