<?php
require 'User.php';
class Controller
{
    public function routeRequest()
    {
        $file = (string) filter_input(INPUT_GET, 'ctrl') . '.php';
        if ($file != false && $file != null && file_exists('Controllers/'.$file)) { // vérifie si il ne vaut pas null et si le fichier existe existe
            require $file;  // require le fichier qui contient la classe souhaitée
            $controller = new $_GET['ctrl'](); // récupère dans une variable l'objet créé de la classe souhaitée
            if (isset($_GET['action']) && $_GET['action'] != '') { // si une méthode est demandée et qu'elle n'est pas vide
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