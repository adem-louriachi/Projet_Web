<?php

class User
{
    private $mail;
    private $pwd;
    private $nick;
    private $admin;

    public function __construct($_mail,$_pwd, $_nick){
        $this->setMail($_mail);
        $this->setPwd($_pwd);
        $this->setNick($_nick);
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    private function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function register(){
        if(isset($_POST['nick']) && $_POST['nick'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['pwd']) && $_POST['pwd'] != ""){ # si les champs ont été remplis ( pas de modification du HTML de l'utilisateur )
            $nick = htmlspecialchars($_POST['nick']); # htmlspecialschars pour ne pas interpreter l'HTML potentiellement inséré dans un champ
            $email = htmlspecialchars($_POST['email']);
            $pwd = htmlspecialchars($_POST['pwd']);
            $pwdconf = htmlspecialchars($_POST['pwdconf']);

            if ($pwd != $pwdconf) {  // Si le premier mdp ne correspond pas au second
                $_SESSION['email'] = $email; // Dans une $_SESSION pour que RegisterView puisse y accéder
                $_SESSION['nick'] = $nick;
                $_POST['error']='Les mots de passe ne sont pas les mêmes';
                header('/?ctrl=User'); //Redirige l'utilisateur vers la page RegisterView.php
            }
        }
        else {
            ob_start();
            $style = 'HomeView.css';
            ?>
            <div class="container black">
                <form id="register" method="post" action="/?ctrl=User&action=register">
                    <label name="nick">Nom</label>
                    <input name="nick" type="text" placeholder="Jean" value="<?php if (isset($_SESSION['nick'])) echo $_SESSION['nick']; ?>" required autofocus>
                    <label name="email">Adresse e-mail</label>
                    <input name="email" type="email" placeholder="jean@jean.fr" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" required>
                    <label name="pwd"><?php  if (isset($_POST['error'])) echo "<p style=\"color:red;\">".$_POST['error']."</p>"; ?> Mot de passe</label>
                    <input name="pwd" type="password" required>
                    <label name="pwdconf">Confirmation du mot de passe</label>
                    <input name="pwdconf" type="password" required>
                    <button class="submit btn waves-effect waves-light" type="submit" value="Inscription">Soumettre<i class="material-icons right">send</i></button>
                </form>
            </div>
            <?php
            $content = ob_get_clean();
            require 'Views/TemplateView.php';
        }
    }
}