<?php
require 'Models/UsersMod.php';
class User
{
    public function view()
    {
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        ob_start();
        require 'Views/UsersView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

    public function register()
    {
        $nick = htmlspecialchars($_POST['nick']); # htmlspecialschars pour ne pas interpreter l'HTML potentiellement inséré dans un champ
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $pwdconf = htmlspecialchars($_POST['pwdconf']);

        if ($pwd != $pwdconf) {  // Si le premier mdp ne correspond pas au second

            $_POST['error'] = 'Les mots de passe ne sont pas les mêmes';
            header('/?ctrl=Form&action=register');
        } else {
            session_start();
            $_SESSION['user'] = $nick;
            $user = new UsersMod($nick, $email, $pwd); // création de l'utilisateur (objet)
            $user->insertUser(); // insertion des données dans la Base
            header('Location: /?ctrl=User&action=view');

        }
    }

    public function signin()
    {
        if (UsersMod::testLoginPwd($_POST['login'], $_POST['pwd'])) //vérifie l'existance du login et pwd dans la base
        {
            session_start();
            $_SESSION['user'] = $_POST['login'];
            header('location: Home.php');
        } else {
            //message d'erreur à ajouter
            header('/?ctrl=Form&action=signin'); //reste sur la page signin
        }
    }

    public function signout()
    {
        session_destroy();
        header('location: /');
    }
}