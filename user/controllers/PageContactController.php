<?php
require_once('./views/PageContactView.php');
require_once('./models/PageContactModel.php');
class PageContactController
{
    public function insererContact()
    {
        $contact["nom"] = $_POST["nom"];
        $contact["prenom"] = $_POST["prenom"];
        $contact["email"] = $_POST["email"];
        $contact["telephone"] = $_POST["telephone"];
        $contact["message"] = $_POST["message"];
        $model = new PageContactModel();
        $model->insererContact($contact);
        header("Location: /Projet_tdw/user/contact");
    }
    public function afficherPageContact()
    {
        $view = new PageContactView();
        $view->afficherPageContact();
    }
}