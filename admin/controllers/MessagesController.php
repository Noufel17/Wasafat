<?php
require_once('./views/MessagesView.php');
require_once('./models/MessagesModel.php');

class MessagesController
{
    public function getAllMessages()
    {
        $model = new MessagesModel();
        return $model->getAllMessages();
    }
    public function supprimerMessage(){
        $idMessage = $_POST["idMessage"];
        $model = new MessagesModel();
        $model->supprimerMessage($idMessage);
        header("Location: ./messages");
    }
    public function afficherMessages(){
        $view = new MessagesView();
        $view->afficherMessages();
    }
}