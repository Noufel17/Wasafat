<?php
class PageRecetteModel extends DBconnection
{
    public function getRecetteByid($idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recette WHERE idRecette=:id";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idRecette]);
        $qry = "SELECT AVG(note) AS avg FROM notation WHERE idRecette=:id";
        $stmt2 = $dataBase->prepare($qry);
        $stmt2->execute(['id' => $idRecette]);
        $note = $stmt2->fetch(PDO::FETCH_ASSOC);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($note["avg"]) {
            $result["notation"] = $note["avg"];
        } else {
            $result["notation"] = 0;
        }
        $this->disconnect($dataBase);
        return $result;
    }
    public function getEtapesRecette($idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT idEtape,numEtape,descriptionEtape FROM etape WHERE idRecette=:id ORDER BY numEtape";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idRecette]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getIngredientsRecette($idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT *
         FROM ingredient i INNER JOIN secompose s ON i.idIngredient=s.idIngredient WHERE idRecette=:id";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idRecette]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function handleNotation($idUser, $idRecette, $note)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM notation WHERE idRecette = :idRecette AND idUtilisateur = :idUser";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idRecette' => $idRecette, 'idUser' => $idUser]);
        $result = $stmt->fetch();
        if ($result) {
            $qry = "UPDATE notation SET note = :note";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(['note' => $note]);
        } else {
            $qry = "INSERT INTO notation (idRecette,idUtilisateur,note)
            VALUES (:idRecette,:idUser,:note)";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(['idRecette' => $idRecette, 'idUser' => $idUser, 'note' => $note]);
        }
        $this->disconnect($dataBase);
    }
    public function handleAjouterFavories($idUser, $idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "INSERT INTO recettesfavories (idRecette,idUtilisateur) VALUES (:idRecette,:idUser)";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idRecette' => $idRecette, 'idUser' => $idUser]);
        $this->disconnect($dataBase);
    }
    public function handleRemoveFavories($idUser, $idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "DELETE FROM recettesfavories WHERE idRecette=:idRecette AND idUtilisateur=:idUser";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idRecette' => $idRecette, 'idUser' => $idUser]);
        $this->disconnect($dataBase);
    }
    public function verifyFavorie($idUser, $idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recettesfavories WHERE idRecette=:idRecette AND idUtilisateur=:idUser";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['idRecette' => $idRecette, 'idUser' => $idUser]);
        $result = $stmt->fetch();
        if ($result) {
            $this->disconnect($dataBase);
            return true;
        }
        $this->disconnect($dataBase);
        return false;
    }
}