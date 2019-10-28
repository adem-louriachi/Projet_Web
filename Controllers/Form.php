<?php
class Form
{
    public function register(){
        require 'AuthenticationCheck.php';
        require '../Views/RegisterView.php'
    }

    public function signin(){
        require 'AuthenticationCheck.php';
        require '../Views/SigninView.php';
    }
    public function forget(){
        echo 'oui';
    }
    public function show(){
        header('Location: /');
    }
}