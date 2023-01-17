<?php
class PageFeteModel extends DBconnection
{
    public function getRecettesFetes()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recette WHERE idFete > 0 AND etat=1";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getRecettesbyFete($idFete)
    {

        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        if ($idFete == 0) {
            $qry = "SELECT * FROM recette WHERE idFete > 0 AND etat=1";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
        } else {
            $qry = "SELECT * FROM recette WHERE idFete = :idFete AND etat=1";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idFete" => $idFete]);
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getFetes()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM fete";
        $result = $this->requete($dataBase, $qry);
        $this->disconnect($dataBase);
        return $result;
    }
}