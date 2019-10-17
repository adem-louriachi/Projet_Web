<?php
    require "../Models/UsersMod.php";


    if (isset($_POST['login'],$_POST['pwd']))
    {
        $pwd = getPwdBD($_POST['login']);


        if ($nick == $_POST['login'] &&  $pwd == md5($_POST['pwd']))
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = md5($_POST['login']);
            header('Location: ../Views/UsersView.php');
        }
        else if ($nick == $_POST['login'] && $pwd != md5($_POST['pwd']))
        {
            //message erreur
            header('Location: ../Views/SigninView.php');
        }
        else
        {
            //message erreur
            header('Location: ../Views/SigninView.php');
        }
    }