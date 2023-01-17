<?php
require_once('./models/DBconnection.php');
class GestionRecettesModel extends DBconnection
{
    public function getRecetteById($idRecette){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $qry = "SELECT 
                Table2.idRecette,recette.nomRecette,recette.recetteImage,recette.description,recette.tempsPreparation,
                recette.nombreCalories,recette.tempsCuission,recette.tempsRepos,recette.recetteVideo,recette.difficulte,
                recette.etat,categorie,table3.notation, recette.tempsPreparation+
                recette.tempsCuission+recette.tempsRepos AS tempsTotal,recette.healthy,recette.idFete,
                (CASE WHEN COUNT = 0 THEN NULL ELSE saisonNaturelle END) AS saisonNaturelle
            FROM (
                SELECT
                    MAX(count) AS COUNT,idRecette,saisonNaturelle
                FROM
                    (
                    SELECT
                        saisonNaturelle,COUNT(i.saisonNaturelle) AS COUNT,r.idRecette
                    FROM
                        secompose s
                    LEFT OUTER JOIN ingredient i ON
                        s.idIngredient = i.idIngredient
                    LEFT OUTER JOIN recette r ON
                        r.idRecette = s.idRecette
                    GROUP BY
                        r.idRecette,
                        i.saisonNaturelle
                ) AS Table1
                GROUP BY idRecette ) AS Table2
            JOIN recette on recette.idRecette = Table2.idRecette LEFT OUTER JOIN (
                SELECT idRecette,AVG(note) AS notation FROM notation GROUP BY idRecette
            ) table3 ON table3.idRecette = Table2.idRecette 
            HAVING idRecette=:idRecette";
            
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette" => $idRecette
                ]);
                $result = $stmt->fetch();
            $this->disconnect($dataBase);
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        
    }
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
        try{
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM fete";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->disconnect($dataBase);
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function validerRecette($idRecette){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "UPDATE recette SET etat=1 WHERE idRecette=:idRecette";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idRecette"=>$idRecette]);
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function modifierEtapes(
        $numEtape,
        $descriptionEtape,
        $idEtape
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            foreach ($numEtape as $key => $value) {
                $qry = "UPDATE etape SET numEtape=:numEtape,DescriptionEtape=:descriptionEtape 
                 WHERE idEtape=:idEtape";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "numEtape" => $value, "descriptionEtape" => $descriptionEtape[$key],
                    "idEtape" => $idEtape[$key]
                ]);
            }
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function modifierSecompose(
        $idIngredient,
        $quantite,
        $unite
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            foreach ($idIngredient as $key => $value) {
                $qry = "UPDATE SET secompose quantiteIngredient=:quantite,unite=:unite 
                    WHERE idIngredient=:idIngredient";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                 "idIngredient" => $value,
                    "quantite" => $quantite[$key], "unite" => $unite[$key]
                ]);
            }
            $this->disconnect($dataBase);
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
    public function modifierRecette(
        $idRecette,
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
        $idEtape,
        $numEtape,
        $descriptionEtape,
        $recetteImageName,
        $recetteVideoName,
        $addedIdIngredient,
        $addedQuantite,
        $addedUnite,
        $addedNumEtape,
        $addedDescriptionEtape
        )
        {
        // echo $idRecette;
        // echo $nom;
        // echo $tcuiss;
        // echo $tprepa;
        // echo $trepos;
        // echo $healthy;
        // echo $difficulte;
        // echo $category;
        // echo $descriptionRecette;
        // echo $calories;
        // echo $idFete;
        // print_r($idIngredient);
        // print_r($quantite);
        // print_r($unite);
        // print_r($numEtape);
        // print_r($descriptionEtape);
        // echo $recetteImageName;
        // echo $recetteVideoName;
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            // cas trivial il faut faire 4 cas par rapport au image name et video name
            if($recetteImageName != NULL && $recetteVideoName != NULL){
                $qry = "UPDATE recette SET nomRecette=:nom,tempsPreparation=:tprepa,TempsCuission=:tcuiss,TempsRepos=:tropos,nombreCalories=:calories,difficulte=:difficulte,categorie=:category,recetteImage=:recetteImageName,
                recetteVideo=:recetteVideoName,healthy=:healthy,description=:descriptionRecette,idFete=:idFete,etat=:etat  WHERE idRecette=:idRecette";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette"=>$idRecette,"nom" => $nom, "tprepa" => $tprepa, "tcuiss" => $tcuiss, "tropos" => $trepos, "calories" => $calories,
                    "difficulte" => $difficulte, "category" => $category,
                    "recetteImageName" => $recetteImageName, "recetteVideoName" => $recetteVideoName, "healthy" => $healthy,
                    "descriptionRecette" => $descriptionRecette, "idFete" => $idFete, "etat" => 1
                ]); 
            }
            if($recetteImageName != NULL && $recetteVideoName == NULL){
                $qry = "UPDATE recette SET nomRecette=:nom,tempsPreparation=:tprepa,TempsCuission=:tcuiss,TempsRepos=:tropos,nombreCalories=:calories,difficulte=:difficulte,categorie=:category,recetteImage=:recetteImageName,
                healthy=:healthy,description=:descriptionRecette,idFete=:idFete,etat=:etat  WHERE idRecette=:idRecette";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette"=>$idRecette,"nom" => $nom, "tprepa" => $tprepa, "tcuiss" => $tcuiss, "tropos" => $trepos, "calories" => $calories,
                    "difficulte" => $difficulte, "category" => $category,
                    "recetteImageName" => $recetteImageName,"healthy" => $healthy,
                    "descriptionRecette" => $descriptionRecette, "idFete" => $idFete, "etat" => 1
                ]); 
            }
            if($recetteImageName == NULL && $recetteVideoName != NULL){
                $qry = "UPDATE recette SET nomRecette=:nom,tempsPreparation=:tprepa,TempsCuission=:tcuiss,TempsRepos=:tropos,nombreCalories=:calories,difficulte=:difficulte,categorie=:category,
                recetteVideo=:recetteVideoName,healthy=:healthy,description=:descriptionRecette,idFete=:idFete,etat=:etat  WHERE idRecette=:idRecette";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette"=>$idRecette,"nom" => $nom, "tprepa" => $tprepa, "tcuiss" => $tcuiss, "tropos" => $trepos, "calories" => $calories,
                    "difficulte" => $difficulte, "category" => $category,
                    "recetteVideoName" => $recetteVideoName,"healthy" => $healthy,
                    "descriptionRecette" => $descriptionRecette, "idFete" => $idFete, "etat" => 1
                ]); 
            }
            if($recetteImageName == NULL && $recetteVideoName == NULL){
                $qry = "UPDATE recette SET nomRecette=:nom,tempsPreparation=:tprepa,TempsCuission=:tcuiss,TempsRepos=:tropos,nombreCalories=:calories,difficulte=:difficulte,categorie=:category,
                healthy=:healthy,description=:descriptionRecette,idFete=:idFete,etat=:etat  WHERE idRecette=:idRecette";
                $stmt = $dataBase->prepare($qry);
                $stmt->execute([
                    "idRecette"=>$idRecette,"nom" => $nom, "tprepa" => $tprepa, "tcuiss" => $tcuiss, "tropos" => $trepos, "calories" => $calories,
                    "difficulte" => $difficulte, "category" => $category,"healthy" => $healthy,
                    "descriptionRecette" => $descriptionRecette, "idFete" => $idFete, "etat" => 1
                ]); 
            }
            $this->modifierEtapes(
                $numEtape,
                $descriptionEtape,
                $idEtape
            );
            $this->modifierSecompose(
                $idIngredient,
                $quantite,
                $unite
            );
            if($addedIdIngredient[0]!=0){ // not empty array
                $this->insererSecompose(
                    $idRecette,
                    $addedIdIngredient,
                    $addedQuantite,
                    $addedUnite
                );
            }
            if($addedNumEtape[0]!=0){ // not empty array
                $this->insererEtapes(
                    $addedNumEtape,
                    $addedDescriptionEtape,
                    $idRecette
                );
            }
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    
    public function supprimerRecette($idRecette){
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "DELETE FROM recette WHERE idRecette=:idRecette";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idRecette"=>$idRecette]);
            $this->disconnect($dataBase);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getAllRecettes()
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT 
            Table2.idRecette,recette.nomRecette,recette.recetteImage,recette.description,recette.tempsPreparation,
            recette.nombreCalories,recette.tempsCuission,recette.tempsRepos,recette.recetteVideo,recette.difficulte,
            recette.etat,categorie,table3.notation, recette.tempsPreparation+
            recette.tempsCuission+recette.tempsRepos AS tempsTotal,recette.idFete,
            (CASE WHEN COUNT = 0 THEN NULL ELSE saisonNaturelle END) AS saisonNaturelle
        FROM (
            SELECT
                MAX(count) AS COUNT,idRecette,saisonNaturelle
            FROM
                (
                SELECT
                    saisonNaturelle,COUNT(i.saisonNaturelle) AS COUNT,r.idRecette
                FROM
                    secompose s
                LEFT OUTER JOIN ingredient i ON
                    s.idIngredient = i.idIngredient
                LEFT OUTER JOIN recette r ON
                    r.idRecette = s.idRecette
                GROUP BY
                    r.idRecette,
                    i.saisonNaturelle
            ) AS Table1
            GROUP BY idRecette ) AS Table2
        JOIN recette on recette.idRecette = Table2.idRecette LEFT OUTER JOIN (
            SELECT idRecette,AVG(note) AS notation FROM notation GROUP BY idRecette
        ) table3 ON table3.idRecette = Table2.idRecette";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getEtapesRecette($idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT idEtape,numEtape,DescriptionEtape FROM etape WHERE idRecette=:id ORDER BY numEtape";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idRecette]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getIngredientsRecette($idRecette)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT *
         FROM ingredient i INNER JOIN secompose s ON i.idIngredient=s.idIngredient WHERE idRecette=:id";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['id' => $idRecette]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
}