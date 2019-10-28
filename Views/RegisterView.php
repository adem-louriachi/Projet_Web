<?php
$style = 'Views/HomeView.css';
ob_start();
?>
    <div class="container black">
        <form id="register" method="post" action="/?ctrl=User&action=register">
            <label name="nick">Pseudo</label>
            <input name="nick" type="text" placeholder="Wankil"
                   value="<?php if (isset($_SESSION['nick'])) echo $_SESSION['nick']; ?>" autocomplete="nickname" required autofocus>
            <label name="email">Adresse e-mail</label>
            <input name="email" type="email" placeholder="coucou@wankil.fr"
                   value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" autocomplete="email" required>
            <label
                name="pwd"><?php if (isset($_POST['error'])) echo "<p style=\"color:red;\">" . $_POST['error'] . "</p>"; ?>
                Mot de passe</label>
            <input name="pwd" type="password" autocomplete="new-password" required>
            <label name="pwdconf">Confirmation du mot de passe</label>
            <input name="pwdconf" type="password" autocomplete="new-password" required>
            <button class="submit btn waves-effect waves-light" type="submit" value="Inscription">Soumettre<i
                    class="material-icons right">send</i></button>
        </form>
    </div>
<?php
$content = ob_get_clean();
require 'Views/TemplateView.php';
?>