<?php
require_once('./views/PageRecetteView.php');
require_once('./models/PageRecetteModel.php');
class PageRecetteController
{
    public function getRecetteById($idRecette)
    {
        $model = new PageRecetteModel();
        return $model->getRecetteById($idRecette);
    }
    public function getEtapesRecette($idRecette)
    {
        $model = new PageRecetteModel();
        return $model->getEtapesRecette($idRecette);
    }
    public function getIngredientsRecette($idRecette)
    {
        $model = new PageRecetteModel();
        return $model->getIngredientsRecette($idRecette);
    }
    public function handleNotation()
    {
        $model = new PageRecetteModel();
        $note = $_POST["rating"];
        $idUser = $_POST["idUser"];
        $idRecette = $_POST["idRecette"];
        $model->handleNotation($idUser, $idRecette, $note);
        header("Location: /Projet_tdw/user/recette?idRecette=" . $idRecette);
    }
    public function handleAjoutFavories()
    {
        $idUser = $_POST["idUser"];
        $idRecette = $_POST["idRecette"];
        $model = new PageRecetteModel();
        $model->handleAjouterFavories($idUser, $idRecette);
        header("Location: /Projet_tdw/user/recette?idRecette=" . $idRecette);
    }
    public function handleRemoveFavories()
    {
        $idUser = $_POST["idUser"];
        $idRecette = $_POST["idRecette"];
        $model = new PageRecetteModel();
        $model->handleRemoveFavories($idUser, $idRecette);
        header("Location: /Projet_tdw/user/recette?idRecette=" . $idRecette);
    }
    public function verifyFavorie($idUser, $idRecette)
    {
        $model = new PageRecetteModel();
        return $model->verifyFavorie($idUser, $idRecette);
    }
    public function afficherPageRecette($idRecette)
    {
        $view = new PageRecetteView();
        $view->afficherPageRecette($idRecette);
    }
}