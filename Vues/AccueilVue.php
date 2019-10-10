<?php
    ob_start();
    $style = 'Vues/AccueilVue.css';
?>
<form id="inscription" method="post" action="Vues/AccueilVue.php"> <!-- visibility: visible -->
    <label name="nom">Nom</label>
    <input name="nom" type="text" placeholder="Jean" required autofocus>
    <label name="email">Adresse e-mail</label>
    <input name="email" type="email" placeholder="jean@jean.fr" required>
    <label name="mdp">Mot de passe</label>
    <input name="mdp" type="password" required>
    <label name="mdpconf">Confirmation du mot de passe</label>
    <input name="mdpconf" type="password" required>
    <input type="submit" value="Inscription">
</form>
<form id="connexion" method="post" action="Controlleurs/connexion.php"> <!-- visibility: hidden; -->
    <label name="email">Adresse e-mail</label>
    <input name="email" type="email">
    <label name="mdp">Mot de passe</label>
    <input name="mdp" type="password">
    <input type="submit" value="Connexion">
</form>
<a>Déjà inscrit ?</a> <!-- Javascript à écrire pour passer la visibilité d'inscription à connexion -->
<a>Pas encore de compte ?</a>
<?php
    $content = ob_get_clean();
    require 'GabaritVue.php';
?>
