<?php
    session_start();
    $_SESSION['errors'] = array();
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdconf = $_POST['pwdconf'];

    if ($pwd != $pwdconf) {
        $_SESSION['errors'][] = 'Les mots de passe ne sont pas les mêmes';
        $_SESSION['email'] = $email;
        $_SESSION['nick'] = $nick;
        header('Location: ../index.php');
    }