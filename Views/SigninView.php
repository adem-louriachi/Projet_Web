<div class="container black">
    <form id="signin" method="post" action="/?ctrl=User&action=signin">
        <?= $_SESSION['error'] ?>
        <label>Pseudo / Email
            <input name="login" type="text" placeholder="FrenchCookie / french@cookie.fr" required autofocus>
        </label>
        <label>Mot de passe
            <input name="pwd" type="password" required>
        </label>
        <button class="submit btn waves-effect waves-light" type="submit" >Se connecter<i class="material-icons right">send</i></button>
    </form>
</div>
