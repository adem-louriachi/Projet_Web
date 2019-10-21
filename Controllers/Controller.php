<?php

class Controller
{
    private $Request;
    public function routeRequest(){
        try{
            if(isset($Request)){
                require $_GET['ctrl'].'.php';
            }
            else{
                require 'Home.php';
            }
        }
        catch (Exception $e){
            $this->handleErrors($e);
        }
    }

    private function handleErrors(Exception $e){ #gérer les erreurs
        echo 'Erreur : ',$e;
    }
}