<?php
class PageRegisterModel extends DBconnection
{
    public function register($user)
    {
        echo $user['nom'];
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM utilisateur WHERE email=:email";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['email' => $user['email']]);
        $result = $stmt->fetch();
        if ($result) {
            $this->disconnect($dataBase);
            return false;
        }
        $qry = "INSERT INTO utilisateur (nom,prenom,hashedPassword,email,sexe,dateNaissance,valide) 
        VALUES (:nom,:prenom,:hashedPassword,:email,:sexe,:dateNaissance,:valide)";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute([
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'hashedPassword' => password_hash($user['password'], PASSWORD_DEFAULT),
            'email' => $user['email'],
            'sexe' => $user['sexe'],
            'dateNaissance' => $user['dateNaissance'],
            'valide' => 0
        ]);
        $idUser = $dataBase->lastInsertId();
        $this->disconnect($dataBase);
        return $idUser;
    }
}