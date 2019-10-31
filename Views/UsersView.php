
<p>Nom d'utilisateur : <?=$_SESSION['nick']?></p>
<p>Email : <?=$_SESSION['email']?></p>
<p>Date d'inscription : <?=$_SESSION['date']?></p>
<p>Super administrateur : <?=$_SESSION['admin']?></p>
<form id="newMail" method="post" action="/?ctrl=User&action=changeMail">
    <label name="email">Changer d'adresse e-mail</label>
        <input name="email" type="email">
    <input id="submit" type="submit" value="Modifier l'adresse mail">
</form>
<form id="newPwd" method="post" action="/?ctrl=User&action=changePwd">
    <label name="pwd">Changer de mot de passe</label>
        <input name="pwd" type="password">
        <input name="pwdconf" type="password">
    <input id="submit" type="submit" value="Modifier le mot de passe">
</form>
