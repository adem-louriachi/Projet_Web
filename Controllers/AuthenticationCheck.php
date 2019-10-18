<?php
    ob_start();
    if (isset($_SESSION['user'])){
        echo '<li><a href="/?ctrl=user&action=view">Mon compte</a></li><li><a href="/?ctrl=user&action=signout">Se déconnecter</a></li>';
    }
    else{
        echo
            '<li><a href="/?ctrl=user&action=signin">Se connecter</a></li>
            <li><a href="/index.php?ctrl=user&action=register">S\'inscrire</a></li><li><a href="/index.php?ctrl=user&action=forget">Mot de passe oublié</a></li>';
    }
    /*
     *     if (isset($_SESSION['user'])){
        echo '<li><a href="Views/Users /?ctrl=user&action=view">Mon compte</a></li><li><a href="Controllers/Signout.php /?ctrl=user&action=signout">Se déconnecter</a></li>';
    }
    else{
        echo
            '<li><a href="/?ctrl=user&action=signin">Se connecter</a></li>
            <li><a href="Views/RegisterView.php /index.php?ctrl=user&action=register">S\'inscrire</a></li><li><a href="Views /index.php?ctrl=user&action=forget">Mot de passe oublié</a></li>';
    }
    */
    $auth = ob_get_clean();
?>