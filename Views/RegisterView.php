<div class="container black">
    <form id="register" method="post" action="/?ctrl=User&action=register">
        <label>Pseudo
            <input name="nick" type="text" placeholder="Wankil" value="<?= $_POST['nick']?>" autocomplete="nickname" required autofocus>
        </label>
        <label>Adresse e-mail
            <input name="email" type="email" placeholder="coucou@wankil.fr" value="<?= $_POST['email'] ?>" autocomplete="email" required>
        </label>
        <label><?= $_POST['error'] ?>Mot de passe
            <input name="pwd" type="password" autocomplete="new-password" required>
        </label>
        <label>Confirmation du mot de passe
            <input name="pwdconf" type="password" autocomplete="new-password" required>
        </label>
        <button class="submit btn waves-effect waves-light" type="submit" value="Inscription">Soumettre<i
                class="material-icons right">send</i></button>
    </form>
</div>