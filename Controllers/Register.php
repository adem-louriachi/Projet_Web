<?php
    session_start();
    $_SESSION['errors'] = array();
    $nick = htmlspecialchars($_POST['nick']); // htmlspecialschars pour ne pas interpreter l'HTML potentiellement inséré dans un champ
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $pwdconf = htmlspecialchars($_POST['pwdconf']);

    if ($pwd != $pwdconf) {  // Si le premier mdp ne correspond pas au second
        $_SESSION['errors'][] = 'Les mots de passe ne sont pas les mêmes';
        $_SESSION['email'] = $email; // Dans une $_SESSION pour que RegisterView puisse y accéder
        $_SESSION['nick'] = $nick;
        header('Location: /Views/RegisterView.php'); // Redirige l'utilisateur vers la page RegisterView.php
    }