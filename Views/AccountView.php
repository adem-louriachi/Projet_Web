<?php
session_start();
ob_start();
$style = 'Views/UsersView.css';
?>
<p>Nom d'utilisateur : <? user.getNick(); ?></p>
<p>Email : <? user.getMail(); ?></p>
<p>Date d'inscription : <? user.getDate(); ?>
<p>Super aministrateur : <? if (user.getAdmin == 0){ echo "non"} else { echo "oui"}; ?>
<form id="newMail" method="post" action="">
    <label name="email">Changer d'adresse e-mail</label>
        <input name="email" type="email">
    <input id="submit" type="submit" value="Modifier l'adresse mail">
</form>
<form id="newPwd" method="post" action="">
    <label name="pwd">Changer de mot de passe</label>
        <input name="pwd" type="password">
    <input id="submit" type="submit" value="Modifier le mot de passe">
</form>

<?php
    $content = ob_get_clean();
    require 'TemplateView.php';
?>