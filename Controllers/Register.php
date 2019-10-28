<?php
if (isset($_POST['nick']) && $_POST['nick'] != '' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['pwd']) && $_POST['pwd'] != '') { # si les champs ont été remplis ( pas de modification du HTML de l'utilisateur )
    $nick = htmlspecialchars($_POST['nick']); # htmlspecialschars pour ne pas interpreter l'HTML potentiellement inséré dans un champ
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $pwdconf = htmlspecialchars($_POST['pwdconf']);

    if ($pwd != $pwdconf) {  // Si le premier mdp ne correspond pas au second
        $_SESSION['email'] = $email; // Dans une $_SESSION pour que RegisterView puisse y accéder
        $_SESSION['nick'] = $nick;
        $_POST['error'] = 'Les mots de passe ne sont pas les mêmes';
        header('/?ctrl=User?action=register');
    }
}