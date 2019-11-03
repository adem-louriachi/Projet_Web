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
                $_SESSION['giveAdmin'] = '
                <hr>
                <h1>Admin panel</h1>
                <form method="post" action="/?ctrl=User&action=giveAdmin">
                    '.$_SESSION['error']['giveAdmin'].'
                    <label>Donner les droits super utilisateur à ( email )
                        <input name="email" type="text" placeholder="Adresse email de l\'utilisateur">
                    </label>
                    <button class="submit btn waves-effect waves-light" type="submit" value="Envoyer">Envoyer<i class="material-icons right">send</i></button>
                </form>';
                $_SESSION['deleteSmn'] = '
                <form method="post" action="/?ctrl=User&action=deleteSmn">
                    <label>Supprimer le compte d\'un utilisateur ( "supprimer [pseudo du compte à supprimer]" )
                        <input name="delete" type="text" placeholder="supprimer Toto">
                    </label>
                    <button class="submit btn waves-effect waves-light left" type="submit" value="Supprimer le compte">Supprimer le compte<i class="material-icons right">close</i></button>
                </form>
                <br>';
            }
            require 'Views/UsersView.php';
            $content = ob_get_clean();
            require 'Views/TemplateView.php';
            if (isset($_SESSION['error'])) unset($_SESSION['error']);
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
        ob_start();
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
        // fin de génération de mdp aléatoire
        if(UsersMod::forgetPwd($_POST['email'], $newPwd)) {
            $from = ' Freenote-4randoms <freenote-4randoms@alwaysdata.net>';
            $headers = 'From:' . $from . "\n";
            $bndary = md5(uniqid(mt_rand()));
            $headers .= 'Content-type: multipart/alternative; boundary="' . $bndary. '"';
            $to = $_POST['email'];
            $subject = 'Freenote - Mot de passe temporaire';
            $message_text = 'Votre mot de passe temporaire est le' . $newPwd . "\n" . 'Pour votre sécurité, veuillez changer votre mot de passe sur votre page Mon Compte dès que possible' . "\n";
            $message_text = 'Votre mot de passe temporaire est le' . $newPwd . "\n" . 'Pour votre sécurité, veuillez changer votre mot de passe sur votre page Mon Compte dès que possible' . "\n";
            $message_html = '<html><body><p>Votre mot de passe temporaire est le ' . $newPwd . '<br>Pour votre sécurité, veuillez changer votre mot de passe sur votre page <a href="https://freenote-4randoms.alwaysdata.net/?ctrl=User&action=view" target="_blank">Mon Compte</a> dès que possible<br><a href="https://freenote-4randoms.alwaysdata.net/?ctrl=User&action=signin" target="_blank">Se connecter</a></p></body></html>';
            $message = '--' . $bndary . "\n";
            $message .= 'Content-Type: text/plain; charset=utf-8' . "\n\n";
            $message .= $message_text . "\n\n";
            $message .= '--' . $bndary . "\n";
            $message .= 'Content-Type: text/html; charset=utf-8' . "\n\n";
            $message .= $message_html . "\n\n";
            $_SESSION['test'] .= 'Email généré';
            if(mail($to, $subject, $message, $headers)) $_SESSION['test'] .= 'Email potentiellement envoyé';
            else $_SESSION['test'] .= 'Envoi échoué';
            $_SESSION['clear'] = ob_get_clean();
            header('/?ctrl=Form&action=signin');
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
        if(preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $_POST['email'])) {
            UsersMod::setAdmin($_POST['email'], 1);
            $_SESSION['success'] = 'Si ' . $_POST['email'] . ' existe, cet utilisateur a reçu les privilèges super utilisateur';
            header('Location: /');
        }
        else{
            $_SESSION['error']['giveAdmin'] = 'Email non conforme, veuillez réessayer';
        }
    }

    public static function delete(){
        if ($_POST['delete'] == 'supprimer '.$_SESSION['nick']){
            UsersMod::deleteUser($_SESSION['nick']);
            session_destroy();
            session_start();
            $_SESSION['success'] = 'Votre compte a bien été supprimé';
            header('Location: /');
        } else{
            $_SESSION['error']['delete'] = 'Texte erroné';
            header('/?ctrl=User&action=view');
        }
    }

    public static function deleteSmn(){ // ( delete Someone )
        if ($_SESSION['admin'] == 1) {
            list($suppr, $nick) = explode(' ', $_POST['delete']);
            if (UsersMod::userExist($nick) && $suppr == 'supprimer'){
                UsersMod::deleteUser($nick);
                $_SESSION['success'] = 'Le compte de ' . $nick . ' a bien été supprimé';
                header('Location: /');
            }
        }
        else{
            self::signout();
        }
    }
}