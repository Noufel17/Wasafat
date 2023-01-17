<?php
class PageLoginModel extends DBconnection
{
    public function login($email, $password)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM utilisateur WHERE email=:email";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        if ($result) {
            if (password_verify($password, $result['hashedPassword']) && $result['valide']>0) {
                $this->disconnect($dataBase);
                return $result;
            }
        }
        $this->disconnect($dataBase);
        return false;
    }
}