<?php
    require "../Models/UsersMod.php";


    if (isset($_POST['login'],$_POST['pwd']))
    {
        $user = new UsersMod;
        if ($user->testLoginPwd($_POST['login'], $_POST['pwd']))
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            header('location: Home.php');
        }
        else
        {
            header('location: ../Views/SigninView.php');
        }
    }