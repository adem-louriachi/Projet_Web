<?php
    if (isset($_SESSION['user'])){
        echo '<a href="Views/Users">Mon compte</a><a href="Controllers/Signout.php">Se déconnecter</a>';
    }
    else{
        echo '<a href=\'Views/SigninView.php\'>Se connecter</a><a href=\'Views/RegisterView.php\'>S\'inscrire</a><a href=\'Views/\'>Mot de passe oublié</a>';
    }