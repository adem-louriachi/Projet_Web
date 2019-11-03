<div class="row white-text">
    <div class="col s6">
<p>Nom d'utilisateur : <?=$_SESSION['nick']?></p>
<p>Email : <?=$_SESSION['email']?></p>
<p>Date d'inscription : <?=$_SESSION['date']?></p>
<p>Super administrateur : <?=$_SESSION['isAdmin']?></p>
        <div class="col right-align s6">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSc-cK1ui78ki3ur0b4h_OvNdBIhqLGMaRrpV1Dbu-dyTNmyqdMaA&amp;s" class="circle responsive-img">
        </div>
    </div>
</div>
<form id="newMail" method="post" action="/?ctrl=User&action=changeMail">
    <?= $_SESSION['error']['changeEmail'] ?>
    <label>Changer d'adresse e-mail
        <input name="email" type="email">
    </label>
    <button class="submit btn waves-effect waves-light" type="submit" value="Modifier l'adresse email">Modifier l'adresse email<i class="material-icons right">send</i></button>
</form>
<form id="newPwd" method="post" action="/?ctrl=User&action=changePwd">
    <?= $_SESSION['error']['changePwd'] ?>
    <label>Changer de mot de passe
        <input name="pwd" type="password">
        <input name="pwdconf" type="password">
    </label>
    <button class="submit btn waves-effect waves-light" type="submit" value="Modifier le mot de passe">Modifier le mot de passe<i class="material-icons right">send</i></button>
</form>
<form method="post" action="/?ctrl=User&action=delete">
    <?= $_SESSION['error']['delete'] ?>
    <label>Afin de confirmer votre volonté de supprimer votre compte, veuillez écrire "supprimer VOTREPSEUDO" en remplaçant VOTREPSEUDO par le pseudo de votre compte
        <input name="delete" type="text">
    </label>
    <button class="submit btn waves-effect waves-light" type="submit" value="SUPPRIMER mon compte">SUPPRIMER mon compte<i class="material-icons right">send</i></button>
</form>
<?= $_SESSION['giveAdmin'] ?>
<?= $_SESSION['deleteSmn'] ?>
