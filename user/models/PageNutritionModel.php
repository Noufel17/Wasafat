<?php
class PageNutritionModel extends DBconnection
{
    public function getIngredients()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM ingredient";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
}