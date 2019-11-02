<?php
require 'Models/UsersMod.php';
class User
{
    public static function isConnected(){
        if (isset($_SESSION['nick']) && isset($_SESSION['email']) && isset($_SESSION['date']) && isset($_SESSION['admin'])) return true;
        else return false;
    }
    public static function view()
    {
        if (self::isConnected()){
            require 'AccountMenu.php';
            $style = 'Views/HomeView.css';
            ob_start();
            if($_SESSION['admin'] == 0) $_SESSION['isAdmin'] = 'Non';
            else $_SESSION['isAdmin'] = 'Oui 👑';
            require 'Views/UsersView.php';
            $content = ob_get_clean();
            require 'Views/TemplateView.php';
        } else {
            header('Location: /');
        }
    }

    public static function register()
    {
        $nick = htmlspecialchars($_POST['nick']); # htmlspecialschars pour ne pas interpreter l'HTML potentiellement inséré dans un champ
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $pwdconf = htmlspecialchars($_POST['pwdconf']);

        if ($pwd != $pwdconf) {  // Si le premier mdp ne correspond pas au second

            $_POST['error'] = 'Les mots de passe ne sont pas les mêmes';
            header('/?ctrl=Form&action=register');
        } else {
            UsersMod::insertUser($nick, $email, $pwd); // insertion des données dans la Base
        }
    }

    public static function signin()
    {
        $isID = (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $_POST['nick'])) ? false : true;
        $userData = UsersMod::signin($_POST['nick'], $_POST['pwd'], $isID);
        if (isset($userData)) {
            $_SESSION = [
                'nick' => $userData['Nom'],
                'email' => $userData['Mail'],
                'date' => $userData['DateInscription'],
                'admin' => $userData['SuperUtilisateur']
            ];
            header('location: /');
        }
    }

    public static function signout()
    {
        session_destroy();
        header('location: /');
    }
}