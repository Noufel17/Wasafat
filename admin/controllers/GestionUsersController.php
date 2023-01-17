<?php
require_once('./views/GestionUsersView.php');
require_once('./models/GestionUsersModel.php');
require_once('./views/PageProfileView.php');
class GestionUsersController
{
    public function getAllUsers(){
        $model= new GestionUsersModel();
        return $model->getAllUsers();
    }
    public function validerUser($idUser){
        $idUser = $_POST["idUser"];
        $model= new GestionUsersModel();
        $model->validerUser($idUser);
        header("Location: ./gestion-users");
    }
    public function bannerUser($idUser){
        $idUser = $_POST["idUser"];
        $model= new GestionUsersModel();
        $model->bannerUser($idUser);
        header("Location: ./gestion-users");
    }
    public function getUserById($idUser){
        $model= new GestionUsersModel();
        return $model->getUserById($idUser);
    }
    public function getRecettesByUser($idUser){
        $model= new GestionUsersModel();
        return $model->getRecettesByUser($idUser);
    }
    public function  getRecettesFavories($idUser){
        $model= new GestionUsersModel();
        return $model->getRecettesFavories($idUser);
    }
    public function afficherPageProfile($idUser){
        $view = new PageProfileView();
        $view->afficherPageProfile($idUser);
    }
    
    public function afficherGestionUsers(){
        $view = new GestionUsersView();
        $view->afficherGestionUsers();
    }
}