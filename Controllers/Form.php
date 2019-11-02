<?php
class Form
{
    public static function register(){
        require 'AccountMenu.php';
        $style = 'Views/HomeView.css';
        ob_start();
        $_POST['nick'] = filter_input(INPUT_POST, 'nick');
        $_POST['email'] = filter_input(INPUT_POST, 'email');
        $_SESSION['error'] = '<p style="color:red;">'.$_SESSION['error'].'</p>';
        require 'Views/RegisterView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
        unset($_SESSION['error']);
    }

    public static function signin(){
        require 'AccountMenu.php';
        $style = 'Views/HomeView.css';
        ob_start();
        require 'Views/SigninView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

    public static function forget(){
        require 'AccountMenu.php';
        $style = 'Views/HomeView.css';
        ob_start();
        $_SESSION['error'] = '<p style="color:red;">'.$_SESSION['error'].'</p>';
        require 'Views/ForgetView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
        unset($_SESSION['error']);
    }

    public static function show(){
        header('Location: /');
    }
}