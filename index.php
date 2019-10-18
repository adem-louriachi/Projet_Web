<?php
    session_start();
    if(isset($_GET['ctrl'])){
        require 'Controllers/'.$_GET['ctrl'].'.php';
    }
    else{
        require 'Controllers/Home.php';
    }
/**
routage
Appel controlleur
Autoloader
controlleurs > 'Controllers/' . $_GET ctrl .php
model > rep des modeles / nom du modèle cible

action ?
méthode >  $_GET action **/