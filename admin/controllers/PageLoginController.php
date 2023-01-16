<?php
require_once('./views/PageLoginView.php');
require_once('./models/PageLoginModel.php');

class PageLoginController
{
    public function handleLogin()
    {
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $model = new PageLoginModel();
        $admin = $model->login($username, $password);
        if ($admin) {
            print_r("admin");
            session_start();
            $_SESSION['admin'] = $admin;
            header('Location: /Projet_tdw/admin/acceuil');
            exit();
        } else {
            header('Location: /Projet_tdw/admin/login');
        }
    }
    public function Handlelogout()
    {
        unset($_SESSION['admin']);
        session_start();
        session_destroy();
        header('Location: /Projet_tdw/admin/');
        exit();
    }
    public function afficherPageLogin()
    {
        $view = new PageLoginView();
        $view->afficherPageLogin();
    }
}