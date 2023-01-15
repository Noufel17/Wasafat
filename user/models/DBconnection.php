<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './projet_tdw/user/views/pageAccueilView.php');
class DBconnection
{
    //properties
    protected $DBname = "projet_tdw"; //tdw_php
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";

    //methodes 
    protected function connecterDB($DBname, $host, $user, $password)
    {
        try {
            $dataBase = new PDO("mysql:host=$host;dbname=$DBname;charset=utf8", $user, $password);
        } catch (PDOException $error) {
            printf("erreur lors de la connexion à la base de donnée", $error->getMessage());
            exit();
        }
        return $dataBase;
    }

    protected function requete($dataBase, $query)
    {
        return $dataBase->query($query);
    }
    protected function disconnect(&$dataBase)
    {
        $dataBase = null;
    }
    public function testDB()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        return $dataBase;
    }
}