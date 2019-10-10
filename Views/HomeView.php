<?php
    ob_start();
    $style = 'Views/HomeView.css';
?>
<div class="container">
    <form id="register" method="post" action="Controllers/Register.php"> <!-- visibility: visible -->
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
    <form id="signin" method="post" action="Controllers/Signin.php"> <!-- visibility: hidden; -->
        <label name="email">Adresse e-mail</label>
        <input name="email" type="email">
        <label name="pwd">Mot de passe</label>
        <input name="pwd" type="password">
        <input type="submit" value="Connexion">
    </form>
    <a>Déjà inscrit ?</a> <!-- Javascript à écrire pour passer la visibilité d'inscription à connexion -->
    <a>Pas encore de compte ?</a>
</div>
<section>
    <h2>Description du site</h2>
        <p>
        Bienvenue sur FreeNote ! <br> Un réseau social où les messages privés n'existent pas. <br>
        Vous pouvez lancer une discussion sur un sujet (La mort de Jacques Chirac, Pourquoi il ne faut pas boire de Munster, L'utilité d'un BDE, Greta Thunberg, etc.).
        Puis, vous, cher.ère.s membres, pouvez participer à chaque discussion. <br>
        Cependant, nous ne sommes pas ici pour créer un basique forum. Chacun de vous ne peut écrire que deux mots dans un message sur toute une discussion ET C'EST TOUT. <br>
        Choisissez avec soin...
        </p>
</section>
<?php
    $content = ob_get_clean();
    require 'TemplateView.php';
?>
