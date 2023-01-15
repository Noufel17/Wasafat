<?php
require_once('./views/PageModifierProfileView.php');
require_once('./models/PageModifierProfileModel.php');
class PageModifierProfileController
{
    public function modifierProfile()
    {
        $user["idUser"] = strip_tags(trim($_POST['idUser']));
        $user['email'] = strip_tags(trim($_POST['email']));
        $user['nom'] = strip_tags(trim($_POST['nom']));
        $user['prenom'] = strip_tags(trim($_POST['prenom']));
        $user['dateNaissance'] = strip_tags(trim($_POST['dateNaissance']));
        $user['sexe'] = strip_tags(trim($_POST['sexe']));
        if (isset($_FILES["profileImage"])) {
            $profileImage = $_FILES["profileImage"];
        }
        // uploader le ficher de l'image


        if ($profileImage["error"] == 0) {
            $r = explode(".", $profileImage["name"]);
            $profileImageName = $r[0];
            $profileImageExt = strtolower(end($r));
            $tmpImage = $profileImage["tmp_name"];
            while (!is_uploaded_file($tmpImage)) {
                // wait untill file is uploaded
            }
            if (in_array($profileImageExt, array('jpg', 'jpeg', 'png'))) {
                $imageDest = "public/images/profile/" . $profileImage["name"];
                move_uploaded_file($tmpImage, $imageDest);
                unlink("public/images/profile" . $_POST["oldImage"]);
                $profileImageName = "/" . $profileImageName;
            }
        } else {
            $profileImageName = NULL;
        }
        if (isset($_POST['password']) && isset($_POST['password']) != NULL) {
            $user["password"] = strip_tags(trim($_POST['password']));
        } else {
            $user["password"] = NULL;
        }
        $user['profileImage'] = $profileImageName;
        $model = new PageModifierProfileModel();
        $model->modifierProfile($user);
        unset($_SESSION['user']);
        session_start();
        session_destroy();
        header('Location: /Projet_tdw/user/login');
    }
    public function afficherPageModifierProfile()
    {
        $view = new PageModifierProfileView();
        $view->afficherPageModifierProfile();
    }
}