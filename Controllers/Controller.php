<?php

class Controller
{
    private $Request;
    public function routeRequest(){
        if(isset($Request)){
            require $_GET['ctrl'].'.php';
        }
        else{
            require 'Home.php';
        }
    }
}