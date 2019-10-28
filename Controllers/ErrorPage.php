<?php


class ErrorPage
{
    public function error(){
        ob_start();
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        if (isset($_GET['error']) && $_GET['error'] != ''){
            $error = $_GET['error']; echo 'Erreur '.$error.' : ';
            switch ($error){
                case 401:
                    echo 'Vous n\'êtes pas connecté';
                    break;
                case 403:
                    echo 'Accès refusé';
                    break;
                case 404:
                    echo 'Page introuvable';
                    break;
                case 500:
                    echo 'Erreur interne du serveur';
                    break;
                case 503:
                    echo 'Service indisponible, réessayez plus tard';
                    break;
                default:
                    echo '';
            }
        }
        else{
            echo 'Erreur inconnue';
        }
            ?>
            <br>
            <a href="/">Retourner à l'accueil</a>
        <?php
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }
    public function show(){
        ob_start();
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';?>
            Une erreur s'est produite<br>
            <a href="/">Retourner à l'accueil</a>
        <?php
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }
}