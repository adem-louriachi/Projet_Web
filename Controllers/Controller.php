<?php

class Controller
{
    private $request;
    private $action;
    public function routeRequest()
    {
        if (isset($_GET['ctrl']) && $_GET['ctrl'] != "") {
            require $_GET['ctrl'] . '.php';  // require le fichier qui contient la classe souhaitée
            $controller = new $_GET['ctrl'](); // récupère dans une variable l'objet créé de la classe souhaitée
            if (isset($_GET['action']) && $_GET['action'] != "") { // si une méthode est demandée et qu'elle n'est pas vide
                $action = $_GET['action'];
                $controller->$action(); // on appelle la méthode de l'objet créé avant le if
            }
            else {
                $controller->show(); // méthode utilisée par défaut si il n'y a pas de méthode donnée dans l'URL
            }
        } else {
            require 'Home.php'; // fichier require par défaut si on ne précise pas ce que l'on veut dans l'URL ( si on ne demande rien on affiche l'accueil )
        }

    }
}