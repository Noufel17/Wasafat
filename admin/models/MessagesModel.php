<?php
require_once('./models/DBconnection.php');
class MessagesModel extends DBconnection
{
    public function getAllMessages()
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM contact";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}