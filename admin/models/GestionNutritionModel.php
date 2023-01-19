<?php
require_once('./models/DBconnection.php');
class GestionNutritionModel extends DBconnection
{
    public function getAllIngredients(){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM ingredient";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function ajouterIngredient(
        $nomIngredient,
        $calories,
        $healthy,
        $saisonNaturelle,
        $proportionHealthy
    ){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "INSERT INTO ingredient (nomIngredient,calories,healthy,saisonNaturelle,proportionHealthy)
            VALUES (:nomIngredient,:calories,:healthy,:saisonNaturelle,:proportionHealthy)";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "nomIngredient"=>$nomIngredient,
                "calories"=>$calories,
                "healthy"=>$healthy,
                "saisonNaturelle"=>$saisonNaturelle,
                "proportionHealthy"=>$proportionHealthy
            ]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }public function modifierIngredient(
        $idIngredient,
        $nomIngredient,
        $calories,
        $healthy,
        $saisonNaturelle,
        $proportionHealthy
    ){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            if($proportionHealthy != NULL){
                $qry = "UPDATE ingredient SET nomIngredient=:nomIngredient,calories=:calories,healthy=:healthy,saisonNaturelle=:saisonNaturelle,proportionHealthy=:proportionHealthy
                WHERE idIngredient=:idIngredient";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idIngredient"=>$idIngredient,
                    "nomIngredient"=>$nomIngredient,
                    "calories"=>$calories,
                    "healthy"=>$healthy,
                    "saisonNaturelle"=>$saisonNaturelle,
                    "proportionHealthy"=>$proportionHealthy
                ]);
            }else{
                $qry = "UPDATE ingredient SET nomIngredient=:nomIngredient,calories=:calories,healthy=:healthy,saisonNaturelle=:saisonNaturelle
                WHERE idIngredient=:idIngredient";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idIngredient"=>$idIngredient,
                    "nomIngredient"=>$nomIngredient,
                    "calories"=>$calories,
                    "healthy"=>$healthy,
                    "saisonNaturelle"=>$saisonNaturelle
                ]);
            }
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function supprimerIngredient($idIngredient){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "DELETE FROM ingredient WHERE idIngredient=:idIngredient";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idIngredient"=>$idIngredient]);
            $qry2 = "DELETE FROM secompose WHERE idIngredient=:idIngredient";
            $stmt2 = $dataBase->prepare($qry2);
            $stmt2->execute(["idIngredient"=>$idIngredient]);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getIngredientById($idIngredient){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM ingredient WHERE idIngredient=:idIngredient";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idIngredient"=>$idIngredient]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}