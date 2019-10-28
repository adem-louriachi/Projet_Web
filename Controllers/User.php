<?php
class User
{
    public function view()
    {
        require 'AuthenticationCheck.php';
        $style = 'Views/HomeView.css';
        ob_start();
        require 'Views/UsersView.php';
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }

    public function signout()
    {
        session_destroy();
        header('location: Controllers/Home.php');
    }
}