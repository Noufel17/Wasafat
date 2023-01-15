<?php
class PageModifierProfileModel extends DBconnection
{
    public function modifierProfile($user)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        if ($user['password'] != NULL && $user["profileImage"] != NULL) {
            $qry = "UPDATE utilisateur SET
            nom=:nom,prenom=:prenom,sexe=:sexe,
             hashedPassword=:hashedPassword,dateNaissance=:dateNaissance,
             imageProfile=:profileImage;
             WHERE idUtilisateur=:idUser";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "idUser" => $user["idUser"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "sexe" => $user["sexe"],
                "dateNaissance" => $user["dateNaissance"],
                "hashedPassword" => password_hash($user['password'], PASSWORD_DEFAULT),
                "profileImage" => $user["profileImage"]
            ]);
        }
        if ($user['password'] == NULL && $user["profileImage"] != NULL) {
            $qry = "UPDATE utilisateur SET
            nom=:nom,prenom=:prenom,sexe=:sexe,
             dateNaissance=:dateNaissance,
             imageProfile=:profileImage;
             WHERE idUtilisateur=:idUser";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "idUser" => $user["idUser"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "sexe" => $user["sexe"],
                "dateNaissance" => $user["dateNaissance"],
                "profileImage" => $user["profileImage"]
            ]);
        }
        if ($user['password'] != NULL && $user["profileImage"] == NULL) {
            $qry = "UPDATE utilisateur SET
            nom=:nom,prenom=:prenom,sexe=:sexe,
             dateNaissance=:dateNaissance,
             hashedPassword=:hashedPassword
             WHERE idUtilisateur=:idUser";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "idUser" => $user["idUser"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "sexe" => $user["sexe"],
                "dateNaissance" => $user["dateNaissance"],
                "hashedPassword" => password_hash($user['password'], PASSWORD_DEFAULT),
            ]);
        }
        if ($user['password'] == NULL && $user["profileImage"] == NULL) {
            $qry = "UPDATE utilisateur SET
            nom=:nom,prenom=:prenom,sexe=:sexe,
             dateNaissance=:dateNaissance,
             WHERE idUtilisateur=:idUser";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "nom" => $user["nom"],
                "prenom" => $user["prenom"],
                "sexe" => $user["sexe"],
                "dateNaissance" => $user["dateNaissance"],
                "idUser" => $user["idUser"]
            ]);
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
}