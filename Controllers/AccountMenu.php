<?php
    if ($_GET['ctrl'] != 'User') require 'User.php';
    ob_start();
    echo '<li><button name = "LoadGameTest" class="submit btn waves-effect waves-light" type="submit">Charger GameTest</button></li>';
    if (User::isConnected()){
        echo '<li><a href="/?ctrl=User&action=view" class="waves-effect waves-light btn">Mon compte</a></li><li><a href="/?ctrl=User&action=signout">Se déconnecter</a></li>';
    }
    else{
        echo
            '<li><a href="/?ctrl=Form&action=signin" class="waves-effect waves-light btn">Se connecter</a></li>
            <li><a href="/?ctrl=Form&action=register" class="waves-effect waves-light btn">S\'inscrire</a></li><li><a href="/?ctrl=Form&action=forget">Mot de passe oublié</a></li>';
    }

    if (isset($_POST['LoadGameTest'])) {
        require 'Models/GameTestDB/LoadGameTestDB.php';
        GameTest::loadGameTest();
    }
    $auth = ob_get_clean();