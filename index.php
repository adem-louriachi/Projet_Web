<?php
    session_start();
    require 'Controllers/Controller.php';

    $routeur = new Controller;
    $routeur->routeRequest();

/**
routage
Appel controlleur
Autoloader
controlleurs > 'Controllers/' . $_GET ctrl .php
model > rep des modeles / nom du modèle cible

action ?
méthode >  $_GET action **/