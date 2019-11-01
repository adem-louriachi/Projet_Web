<?php
class Form
{
    public function register(){
        require 'AccountMenu.php';
        $style = 'Views/HomeView.css';
        ob_start();
        $_POST['nick'] = filter_input(INPUT_POST, 'nick');
        $_POST['email'] = filter_input(INPUT_POST, 'email');
        $_POST['error'] = '<p style="color:red;">'.filter_input(INPUT_POST, 'error').'</p>';
        require 'Views/RegisterView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

    public function signin(){
        require 'AccountMenu.php';
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