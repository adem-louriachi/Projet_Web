<?php
    if (isset($_POST['login'],$_POST['pwd']))
    {
        if ($login == $_POST['login'] &&  $pwd == md5($_POST['pwd']))
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = md5($_POST['login']);
            //afficher page utilisateur
        }
        else if ($login == $_POST['login'] && $pwd != md5($_POST['pwd']))
        {
            //erreur de mdp
        }
        else
        {
            //erreur ce pseudo n'existe pas
        }
    }