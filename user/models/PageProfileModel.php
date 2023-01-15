<?php
class PageProfileModel extends DBconnection
{
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