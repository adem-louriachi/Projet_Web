<?php
session_start();
ob_start();
$style = 'Views/UsersView.css';
$nick = $_SESSION['nick']; // User.getNick();
$email = $_SESSION['email']; // User.getMail();
?>
<p>Nom d'utilisateur : <?= $nick?></p>
<p>Email : <?= $email?></p>
<a href="">Modifier vos informations</a>
<?php
    $content = ob_get_clean();
    require 'TemplateView.php';
?>
