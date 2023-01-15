<?php
require_once('./views/PageRegisterView.php');
require_once('./models/PageRegisterModel.php');

class PageRegisterController
{

    public function handleRegister()
    {
        $user['email'] = strip_tags(trim($_POST['email']));
        $user['password'] = strip_tags(trim($_POST['password']));
        $user['nom'] = strip_tags(trim($_POST['nom']));
        $user['prenom'] = strip_tags(trim($_POST['prenom']));
        $user['dateNaissance'] = strip_tags(trim($_POST['dateNaissance']));
        $user['sexe'] = strip_tags(trim($_POST['sexe']));
        $model = new PageRegisterModel();
        $idUser = $model->register($user);
        if ($idUser) {
            header('Location: /Projet_tdw/user/login');
        }
    }
    public function afficherPageRegister()
    {
        $view = new PageRegisterView();
        $view->afficherPageRegister();
    }
}