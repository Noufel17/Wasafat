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
    public function afficherMessages(){
        $view = new MessagesView();
        $view->afficherMessages();
    }
}