<?php
class Form
{
    public function register(){
        ob_start();
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        ?>
        <div class="container black">
            <form id="register" method="post" action="/?ctrl=User&action=register">
                <label name="nick">Nom</label>
                <input name="nick" type="text" placeholder="Jean"
                       value="<?php if (isset($_SESSION['nick'])) echo $_SESSION['nick']; ?>" required autofocus>
                <label name="email">Adresse e-mail</label>
                <input name="email" type="email" placeholder="jean@jean.fr"
                       value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" required>
                <label
                    name="pwd"><?php if (isset($_POST['error'])) echo "<p style=\"color:red;\">" . $_POST['error'] . "</p>"; ?>
                    Mot de passe</label>
                <input name="pwd" type="password" required>
                <label name="pwdconf">Confirmation du mot de passe</label>
                <input name="pwdconf" type="password" required>
                <button class="submit btn waves-effect waves-light" type="submit" value="Inscription">Soumettre<i
                        class="material-icons right">send</i></button>
            </form>
        </div>
        <?php
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

/*    public function signin()
    {
        if (isset($_POST['login'], $_POST['pwd'])) {
            $pwd = getPwdBD($_POST['login']);


            if ($nick == $_POST['login'] && $pwd == md5($_POST['pwd'])) {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['pwd'] = md5($_POST['login']);
                header('Location: ../Views/UsersView.php');
            } else if ($nick == $_POST['login'] && $pwd != md5($_POST['pwd'])) {
                //message erreur
                header('Location: ../Views/SigninView.php');
            } else {
                //message erreur
                header('Location: ../Views/SigninView.php');
            }
        }
    } */
    public function forget(){
        echo 'oui';
    }
}