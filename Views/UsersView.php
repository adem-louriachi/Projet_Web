
<p>Nom d'utilisateur : <?=$_SESSION['nick']?></p>
<p>Email : <?=$_SESSION['email']?></p>
<p>Date d'inscription : <?=$_SESSION['date']?></p>
<p>Super administrateur : <?=$_SESSION['isAdmin']?></p>
<?= $_SESSION['giveAdmin'] ?>
<form id="newMail" method="post" action="/?ctrl=User&action=changeMail">
    <?= $_SESSION['error']['changeEmail'] ?>
    <label>Changer d'adresse e-mail
        <input name="email" type="email">
    </label>
    <input id="submit" type="submit" value="Modifier l'adresse mail">
</form>
<form id="newPwd" method="post" action="/?ctrl=User&action=changePwd">
    <?= $_SESSION['error']['changePwd'] ?>
    <label>Changer de mot de passe
        <input name="pwd" type="password">
        <input name="pwdconf" type="password">
    </label>
    <input id="submit" type="submit" value="Modifier le mot de passe">
</form>
