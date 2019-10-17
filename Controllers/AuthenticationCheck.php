<?php
    if (isset($_SESSION['user'])){
        echo '<li><a href="Views/Users">Mon compte</a></li><li><a href="Controllers/Signout.php">Se déconnecter</a></li>';
    }
    else{
        echo
            '<li><a href=\'Views/SigninView.php\'>Se connecter</a></li>
            <li><a href=\'Views/RegisterView.php\'>S\'inscrire</a></li><li><a href=\'Views/\'>Mot de passe oublié</a></li>';
    }