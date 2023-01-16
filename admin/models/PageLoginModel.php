<?php
require_once('./models/DBconnection.php');
class PageLoginModel extends DBconnection
{
    public function login($username, $password)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM administrateur WHERE username=:username";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();
        if ($result) {
            if ($password == $result['password']) {
                $this->disconnect($dataBase);
                return $result;
            }
        }
        $this->disconnect($dataBase);
        return false;
    }
}