<?php
class PageNewsModel extends DBconnection
{
    public function getNews()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM news";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
}