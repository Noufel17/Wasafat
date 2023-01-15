<?php
class PageContactModel extends DBconnection
{
    public function insererContact($contact)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "INSERT INTO contact (nom,prenom,email,telephone,message) 
        VALUES (:nom,:prenom,:email,:telephone,:message)";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute([
            "nom" => $contact["nom"],
            "prenom" => $contact["prenom"],
            "email" => $contact["email"],
            "telephone" => $contact["telephone"],
            "message" => $contact["message"]
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
}