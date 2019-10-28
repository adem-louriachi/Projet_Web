<?php
    session_start();
    ob_start();
    $style = 'SigninView.css';
?>
<div class="container black">
    <form id="signin" method="post" action="../Controllers/Signin.php">
        <label name="email">Adresse e-mail</label>
            <input name="email" type="email">
        <label name="pwd">Mot de passe</label>
            <input name="pwd" type="password">
        <input id="submit" type="submit" value="Connexion">
    </form>
</div>
<?php
    $content = ob_get_clean();
    require '../Views/TemplateView.php'
?>
