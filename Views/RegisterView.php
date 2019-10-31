<div class="container black">
    <form id="register" method="post" action="/?ctrl=User&action=register">
        <label name="nick">Pseudo</label>
        <input name="nick" type="text" placeholder="Wankil"
               value="<?= $_POST['nick']?>" autocomplete="nickname" required autofocus>
        <label name="email">Adresse e-mail</label>
        <input name="email" type="email" placeholder="coucou@wankil.fr"
               value="<?= $_POST['email'] ?>" autocomplete="email" required>
        <label
            name="pwd"><?= $_POST['error'] ?>
            Mot de passe</label>
        <input name="pwd" type="password" autocomplete="new-password" required>
        <label name="pwdconf">Confirmation du mot de passe</label>
        <input name="pwdconf" type="password" autocomplete="new-password" required>
        <button class="submit btn waves-effect waves-light" type="submit" value="Inscription">Soumettre<i
                class="material-icons right">send</i></button>
    </form>
</div>