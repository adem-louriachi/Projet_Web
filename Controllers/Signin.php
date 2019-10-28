<?php
require "Models/UsersMod.php";

class Signin
{
    public function signin()
    {
        if (testLoginPwd($_POST['login'], $_POST['pwd'])) //vérifie l'existance du login et pwd dans la base
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            header('location: Controllers/Home.php');
        } else {
            //message d'erreur à ajouter
            header('/?ctrl=Form&action=signin'); //reste sur la page signin
        }
    }
}