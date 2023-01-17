<?php
class PageIdeeRecetteModel extends DBconnection
{
    public function getRecettesParDefaut($saison)
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = " SELECT MAX(notation) as notation FROM (
                SELECT table4.idRecette,saisonNaturelle,notation from (
                SELECT * FROM (
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
                        HAVING
                            saisonNaturelle != 'partout'
                    ) AS Table1
                    GROUP BY idRecette
            ) AS table2 WHERE saisonNaturelle =:saison
            ) as table3 JOIN (
                 SELECT idRecette,AVG(note) AS notation FROM notation GROUP BY idRecette
                ) AS table4 ON table3.idRecette = table4.idRecette
                ) AS table5";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["saison" => $saison]);
            $result = $stmt->fetch();
            // get the maximum notation of the sasion 
            $notation = $result["notation"];
            // get all recettes where  the maximun notation there is
            $sql = "SELECT * FROM recette INNER JOIN
            (
                         
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
           HAVING
               saisonNaturelle != 'partout'
       ) AS Table1
       GROUP BY idRecette ) AS table2 ON recette.idRecette = table2.idRecette 
       
       INNER JOIN (
           
       SELECT idRecette,AVG(note) AS notation FROM notation GROUP BY idRecette
               ) AS table1 ON recette.idRecette = table1.idRecette WHERE saisonNaturelle=:saison AND notation =:notation AND etat=1";
            $stmt2 = $dataBase->prepare($sql);
            $stmt2->execute(["saison" => $saison, "notation" => $notation]);
            $result2 = $stmt2->fetchAll();
            $this->disconnect($dataBase);
            return $result2;
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
            $qry = "SELECT * FROM recette WHERE etat=1";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public function getPourcentage()
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT * FROM context";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result["pourcentage"];
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    public function getIngredientsByrecette($idRecette)
    {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT idIngredient FROM secompose WHERE idRecette=:idRecette";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute(["idRecette" => $idRecette]);
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    public function getRecettesByFilter(
        $tprep,
        $tcuiss,
        $ttotal,
        $notation,
        $saison,
        $calories
    ) {
        try {
            $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
            $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataBase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $qry = "SELECT 
                Table2.idRecette,recette.nomRecette,recette.recetteImage,recette.description,recette.tempsPreparation,
                recette.nombreCalories,recette.tempsCuission,recette.tempsRepos,recette.recetteVideo,recette.difficulte,
                recette.etat,categorie,table3.notation, recette.tempsPreparation+
                recette.tempsCuission+recette.tempsRepos AS tempsTotal,
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

             HAVING (CASE :tprep 
                    WHEN -1 THEN TRUE 
                    WHEN 1 THEN tempsPreparation BETWEEN 10 AND 30
                    WHEN 2 THEN tempsPreparation BETWEEN 30 AND 60
                    WHEN 3 THEN tempsPreparation BETWEEN 60 AND 90
                    WHEN 4 THEN tempsPreparation > 90 
                    END) AND (
                        CASE :tcuiss
                        WHEN -1 THEN TRUE 
                        WHEN 1 THEN tempsCuission BETWEEN 10 AND 30
                        WHEN 2 THEN tempsCuission BETWEEN 30 AND 60
                        WHEN 3 THEN tempsCuission BETWEEN 60 AND 90
                        WHEN 4 THEN tempsCuission > 90 
                    END) AND (
                        CASE :ttotal
                        WHEN -1 THEN TRUE 
                        WHEN 1 THEN tempsTotal BETWEEN 10 AND 30
                        WHEN 2 THEN tempsTotal BETWEEN 30 AND 60
                        WHEN 3 THEN tempsTotal BETWEEN 60 AND 90
                        WHEN 4 THEN tempsTotal > 90 
                    END) AND (
                        CASE :notation
                        WHEN -1 THEN TRUE 
                        WHEN 1 THEN notation < 2
                        WHEN 2 THEN notation BETWEEN 2 AND 3
                        WHEN 3 THEN notation BETWEEN 3 AND 4
                        WHEN 4 THEN notation BETWEEN 4 AND 5
                    END) AND(
                        CASE :saison
                        WHEN -1 THEN TRUE 
                        WHEN 'ete' THEN saisonNaturelle = 'ete' 
                        WHEN 'hiver' THEN saisonNaturelle = 'hiver' 
                        WHEN 'automne' THEN saisonNaturelle = 'automne'
                        WHEN 'printemps' THEN saisonNaturelle = 'printemps' 
                    END) AND (
                        CASE :calories
                        WHEN -1 THEN TRUE 
                        WHEN 1 THEN nombreCalories < 500
                        WHEN 2 THEN nombreCalories BETWEEN 500 AND 1000
                        WHEN 3 THEN nombreCalories BETWEEN 1000 AND 2000
                        WHEN 4 THEN nombreCalories > 2000
                    END
                    ) AND etat=1 ";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "tprep" => $tprep,
                "tcuiss" => $tcuiss,
                "ttotal" => $ttotal,
                "notation" => $notation,
                "saison" => $saison,
                "calories" => $calories
            ]);
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}