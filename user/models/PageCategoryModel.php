<?php
class PageCategoryModel extends DBconnection
{
    public function getRecettesByCategory($idCategory)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM recette WHERE categorie=:category AND etat=1";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['category' => $idCategory]);
        $result = $stmt->fetchAll();
        $this->disconnect($dataBase);
        return $result;
    }
    public function getRecettesByFilter(
        $tprep,
        $tcuiss,
        $ttotal,
        $notation,
        $saison,
        $calories,
        $idCategory
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
                    ) AND categorie = :category AND etat=1";
            $stmt = $dataBase->prepare($qry);
            $stmt->execute([
                "tprep" => $tprep,
                "tcuiss" => $tcuiss,
                "ttotal" => $ttotal,
                "notation" => $notation,
                "saison" => $saison,
                "calories" => $calories,
                "category" => $idCategory
            ]);
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}