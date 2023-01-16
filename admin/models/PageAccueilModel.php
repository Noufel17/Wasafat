<?php
class PageAccueilModel extends DBconnection
{
    public function getRecetteByCategory($category)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recette WHERE categorie=:category LIMIT 10";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['category' => $category]);
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
}