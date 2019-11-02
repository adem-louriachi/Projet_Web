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
            else{
                $_SESSION['isAdmin'] = 'Oui 👑';
                $_SESSION['giveAdmin'] = '<form method="post" action="/?ctrl=User&action=giveAdmin"><label>Donner les droits super utilisateur à ( pseudo ) <input name="nick" type="text"></label><button class="submit btn waves-effect waves-light" type="submit" value="Envoyer">Envoyer<i
                class="material-icons right">send</i></button></form>';
            }
            require 'Views/UsersView.php';
            $content = ob_get_clean();
            require 'Views/TemplateView.php';
            unset($_SESSION['error']);
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

            $_SESSION['error'] = 'Les mots de passe ne sont pas les mêmes';
            header('/?ctrl=Form&action=register');
        } else {
            UsersMod::insertUser($nick, $email, $pwd); // insertion des données dans la Base
        }
    }

    public static function signin()
    {
        $isID = (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $_POST['login'])) ? false : true;
        $userData = UsersMod::signin($_POST['login'], $_POST['pwd'], $isID);
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

    public static function forget(){
        //generation mot de passe aléatoire
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $newPwd = '';

        for ($i = 0; $i < 24; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $newPwd .= $characters[$index];
        }

        for ($i = 0; $i < 5; $i++) {
            for ($i = 0; $i < strlen($newPwd)-1; $i++) {
                if ( (is_int($newPwd[$i])&& is_int($newPwd[$i+1]))) {
                    $newPwd[$i] = random_int(0,9);
                    $newPwd[random_int(0,strlen($newPwd)-1)] = random_int(0,9);
                }
            }
        }
        if(UsersMod::forgetPwd($_POST['email'], $newPwd)) {
            $from = 'freenote-4randoms@alwaysdata.net';
            $to = $_POST['mail'];
            $subject = 'Freenote - Mot de passe temporaire';
            $bndary = md5(uniqid(mt_rand()));
            $message_text = 'Votre mot de passe temporaire est le' . $newPwd . "\n" . 'Pour votre sécurité, veuillez changer votre mot de passe sur votre page Mon Compte dès que possible' . "\n";
            $message_html = '<html><body><p>Votre mot de passe temporaire est le' . $newPwd . "\n" . 'Pour votre sécurité, veuillez changer votre mot de passe sur votre page <a href="https://freenote-4randoms.alwaysdata.net/?ctrl=User&action=view" target="_blank">Mon Compte</a> dès que possible' . "\n" . '<a href="https://freenote-4randoms.alwaysdata.net/?ctrl=User&action=signin" target="_blank">Se connecter</a>' . '</p></body></html>';
            $message = '--' . $bndary . "\n";
            $message .= 'Content-Type: text/plain; charset=utf-8' . "\n\n";
            $message .= $message_text . "\n\n";
            $message .= '--' . $bndary . "\n";
            $message .= 'Content-Type: text/html; charset=utf-8' . "\n\n";
            $message .= $message_html . "\n\n";
            $headers = 'From:' . $from;
            mail($to, $subject, $message, $headers);
            header('/?ctrl=User&action=signin');
        }
    }

    public static function changeMail(){
        UsersMod::setMail($_SESSION['nick'], $_POST['email']);
    }

    public static function changePwd(){
        if ($_POST['pwd'] === $_POST['pwdconf']){
            UsersMod::setPwd($_SESSION['nick'],$_POST['pwd']);
            $_SESSION['success'] = 'Mot de passe changé';
            header('Location: /');
        }
        else {
            $_SESSION['error']['changePwd'] = 'Mots de passe différents';
            header('Location: /?ctrl=User&action=view');
        }
    }

    public static function giveAdmin(){
        UsersMod::setAdmin($_POST['nick'],1);
        $_SESSION['success'] = 'Privilèges Super Utilisateur donnés à '.$_POST['nick'];
        header('Location: /');
    }
}