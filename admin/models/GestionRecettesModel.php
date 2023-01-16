<?php
class GestionRecettesModel extends DBconnection
{
    public function ajouterRecette(
        $nom,
        $tcuiss,
        $tprepa,
        $trepos,
        $healthy,
        $difficulte,
        $category,
        $descriptionRecette,
        $calories,
        $idFete,
        $idIngredient,
        $quantite,
        $unite,
        $numEtape,
        $descriptionEtape,
        $recetteImageName,
        $recetteVideoName
    ) {
        $idRecette = $this->insererRecette(
            $nom,
            $tcuiss,
            $tprepa,
            $trepos,
            $healthy,
            $difficulte,
            $category,
            $descriptionRecette,
            $calories,
            $idFete,
            $recetteImageName,
            $recetteVideoName
        );
        $this->insererEtapes(
            $numEtape,
            $descriptionEtape,
            $idRecette
        );
        $this->insererSecompose(
            $idRecette,
            $idIngredient,
            $quantite,
            $unite
        );
    }
    public function insererRecette(
        $nom,
        $tcuiss,
        $tprepa,
        $trepos,
        $healthy,
        $difficulte,
        $category,
        $descriptionRecette,
        $calories,
        $idFete,
        $recetteImageName,
        $recetteVideoName
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $qry = "INSERT INTO recette (nomRecette,tempsPreparation,TempsCuission,
            TempsRepos,nombreCalories,difficulte,categorie,recetteImage,recetteVideo,
            healthy,description,idFete,etat) 
            VALUES (:nom,:tprepa,:tcuiss,:tropos,:calories,:difficulte,:category,:recetteImageName,
            :recetteVideoName,:healthy,:descriptionRecette,:idFete,:etat)";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "nom" => $nom, "tprepa" => $tprepa, "tcuiss" => $tcuiss, "tropos" => $trepos, "calories" => $calories,
                "difficulte" => $difficulte, "category" => $category,
                "recetteImageName" => $recetteImageName, "recetteVideoName" => $recetteVideoName, "healthy" => $healthy,
                "descriptionRecette" => $descriptionRecette, "idFete" => $idFete, "etat" => 1
            ]);
            $idRecette = $dataBase->lastInsertId();
            $this->disconnect($dataBase);
            return $idRecette;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function insererEtapes(
        $numEtape,
        $descriptionEtape,
        $idRecette
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            foreach ($numEtape as $key => $value) {
                $qry = "INSERT INTO etape (numEtape,descriptionEtape,idRecette) 
                VALUES (:numEtape,:descriptionEtape,:idRecette)";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "numEtape" => $value, "descriptionEtape" => $descriptionEtape[$key],
                    "idRecette" => $idRecette
                ]);
            }
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function insererSecompose(
        $idRecette,
        $idIngredient,
        $quantite,
        $unite
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            foreach ($idIngredient as $key => $value) {
                $qry = "INSERT INTO secompose (idRecette,idIngredient,quantiteIngredient,unite) 
            VALUES (:idRecette,:idIngredient,:quantite,:unite)";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette" => $idRecette, "idIngredient" => $value,
                    "quantite" => $quantite[$key], "unite" => $unite[$key]
                ]);
            }
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getIngredients()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT idIngredient,nomIngredient FROM ingredient";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
    public function getFetes()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM fete";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
    public function getAllRecettes()
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM recette";
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