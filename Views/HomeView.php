<?php
    ob_start();
    $style = 'View/HomeView.css';
?>
<div class="container">
    <form id="register" method="post" action="Controllers/register.php"> <!-- visibility: visible -->
        <label name="nick">Nom</label>
        <input name="nick" type="text" placeholder="Jean" required autofocus>
        <label name="email">Adresse e-mail</label>
        <input name="email" type="email" placeholder="jean@jean.fr" required>
        <label name="pwd">Mot de passe</label>
        <input name="pwd" type="password" required>
        <label name="pwdconf">Confirmation du mot de passe</label>
        <input name="pwdconf" type="password" required>
        <input type="submit" value="Inscription">
    </form>
    <form id="signin" method="post" action="Controllers/signin.php"> <!-- visibility: hidden; -->
        <label name="email">Adresse e-mail</label>
        <input name="email" type="email">
        <label name="pwd">Mot de passe</label>
        <input name="pwd" type="password">
        <input type="submit" value="Connexion">
    </form>
    <a>Déjà inscrit ?</a> <!-- Javascript à écrire pour passer la visibilité d'inscription à connexion -->
    <a>Pas encore de compte ?</a>
</div>
<?php
    $content = ob_get_clean();
    require 'TemplateView.php';
?>
