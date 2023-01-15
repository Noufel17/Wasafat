<?php
class PageSaisonModel extends DBconnection
{
    public function getRecettesSaison($saison)
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT
        Table2.idRecette,recette.nomRecette,recette.recetteImage,recette.description,recette.tempsPreparation,
        recette.tempsCuission,recette.tempsRepos,recette.recetteVideo,recette.difficulte,
        recette.etat,categorie,
        (CASE WHEN COUNT = 0 THEN NULL ELSE saisonNaturelle END) AS saisosNaturelle
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
            HAVING
                saisonNaturelle != 'partout'
        ) AS Table1
        GROUP BY idRecette ) AS Table2
    JOIN recette on recette.idRecette = Table2.idRecette WHERE saisonNaturelle=:saison";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute(['saison' => $saison]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
    public function getSaison()
    {
        $dataBase = $this->connecterDB($this->DBname, $this->host, $this->user, $this->password);
        $qry = "SELECT * FROM context";
        $stmt = $dataBase->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect($dataBase);
        return $result;
    }
}