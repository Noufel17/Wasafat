<?php
class PageNewsDetailsModel extends DBconnection
{
    public function getNewsById($idNews)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM news WHERE idNews=:id";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idNews]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
}