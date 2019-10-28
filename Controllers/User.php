<?php
class User
{
    public function view(){
        require '../Views/UsersView.php';
    }

    public function signout(){
        session_destroy();
        header('location: Home.php');
}