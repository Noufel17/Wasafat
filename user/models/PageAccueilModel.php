<?php
class PageAccueilModel extends DBconnection
{
    public function getMenu()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM menuitem";
        $result = $this->requete($dataBase, $qry);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getDiapo()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM diapoitem";
        $result = $this->requete($dataBase, $qry);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getResauxSociaux()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM reseausocial";
        $result = $this->requete($dataBase, $qry);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getRecetteByCategory($category)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recette WHERE categorie=:category and etat=1 LIMIT 10";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['category' => $category]);
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
}