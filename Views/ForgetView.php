<div class="container black">
    <form id="signin" method="post" action="/?ctrl=User&action=forget">
        <?= $_POST['error'] ?>
        <label>Adresse e-mail
            <input name="nick" type="email" placeholder="coucou@wankil.fr" required autofocus>
        </label>
        <button class="submit btn waves-effect waves-light" type="submit" >Se connecter<i class="material-icons right">send</i></button>
    </form>
</div>