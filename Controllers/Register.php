<?php
    session_start();
    $_SESSION['errors'] = array();
    $nick = htmlspecialchars($_POST['nick']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $pwdconf = htmlspecialchars($_POST['pwdconf']);

    if ($pwd != $pwdconf) {
        $_SESSION['errors'][] = 'Les mots de passe ne sont pas les mêmes';
        $_SESSION['email'] = $email;
        $_SESSION['nick'] = $nick;
        header('Location: ../index.php');
    }