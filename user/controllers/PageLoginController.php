<?php
require_once('./views/PageLoginView.php');
require_once('./models/PageLoginModel.php');

class PageLoginController
{
    public function handleLogin()
    {
        $email = strip_tags(trim($_POST['email']));
        $password = strip_tags(trim($_POST['password']));
        $model = new PageLoginModel();
        $user = $model->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;;
            echo $_SESSION['user'];
            header('Location: /Projet_tdw/user/');
            exit();
        } else {
            header('Location: /Projet_tdw/user/login');
        }
    }
    public function Handlelogout()
    {
        unset($_SESSION['user']);
        session_start();
        session_destroy();
        header('Location: /Projet_tdw/user/');
        exit();
    }
    public function afficherPageLogin()
    {
        $view = new PageLoginView();
        $view->afficherPageLogin();
    }
}