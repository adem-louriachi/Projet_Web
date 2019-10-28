
<p>Nom d'utilisateur : Michel<!--Utiliser la methode getNick--></p>
<p>Email : Michel@michel<!--Utiliser la methode getMail--></p>
<p>Date d'inscription : 18 février 2019<!--Utiliser la methode getDate--></p>
<p>Super administrateur : Non<!--Utiliser la methode getAdmin--></p>
<form id="newMail" method="post" action="../Controllers/User.php">
    <label name="email">Changer d'adresse e-mail</label>
        <input name="email" type="email">
    <input id="submit" type="submit" value="Modifier l'adresse mail">
</form>
<form id="newPwd" method="post" action="../Controllers/User.php">
    <label name="pwd">Changer de mot de passe</label>
        <input name="pwd" type="password">
    <input id="submit" type="submit" value="Modifier le mot de passe">
</form>
