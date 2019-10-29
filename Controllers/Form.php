<?php
class Form
{
    public function register(){
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        ob_start();
        $_POST['nick'] = 'Paulo';
        $_POST['email'] = 'test@test.com';
        $_POST['error'] = 'ça marche pas';
        $nick = filter_input(INPUT_POST, 'nick');
        $email = filter_input(INPUT_POST, 'email');
        $error = '<p style="color:red;">'.filter_input(INPUT_POST, 'error').'</p>';
        require 'Views/RegisterView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

    public function signin(){
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        ob_start();
        require 'Views/SigninView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }
    public function forget(){
        echo 'oui';
    }
    public function show(){
        header('Location: /');
    }
}