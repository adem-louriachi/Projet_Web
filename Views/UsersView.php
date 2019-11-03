<div class="row white-text">
    <div class="col s6">
        <p>Nom d'utilisateur : <?=$_SESSION['nick']?></p>
        <p>Email : <?=$_SESSION['email']?></p>
        <p>Date d'inscription : <?=$_SESSION['date']?></p>
        <p>Super administrateur : <?=$_SESSION['isAdmin']?></p>
    </div>
</div>
<div class="row">
    <div class="col s6">
        <form id="newMail" method="post" action="/?ctrl=User&action=changeMail">
            <?= $_SESSION['error']['changeEmail'] ?>
            <label>Changer d'adresse e-mail
                <input name="email" type="email" placeholder="Nouvelle adresse e-mail">
            </label>
            <button class="submit btn waves-effect waves-light" type="submit" value="Modifier l'adresse email">Modifier l'adresse email<i class="material-icons right">send</i></button>
        </form>
    </div>
    <div class="col s6">
        <form id="newPwd" method="post" action="/?ctrl=User&action=changePwd">
            <?= $_SESSION['error']['changePwd'] ?>
            <label>Changer de mot de passe
                <input name="pwd" type="password" placeholder="Nouveau mot de passe">
                <input name="pwdconf" type="password" placeholder="Confirmation du nouveau mot de passe">
            </label>
            <button class="submit btn waves-effect waves-light" type="submit" value="Modifier le mot de passe">Modifier le mot de passe<i class="material-icons right">send</i></button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col s6">
        <form method="post" action="/?ctrl=User&action=delete">
            <?= $_SESSION['error']['delete'] ?>
            <label>Afin de confirmer votre volonté de supprimer votre compte, veuillez écrire "supprimer VOTREPSEUDO" en remplaçant VOTREPSEUDO par le pseudo de votre compte
                <input name="delete" type="text" placeholder="supprimer moi">
            </label>
            <button class="submit btn waves-effect waves-light" type="submit" value="SUPPRIMER mon compte">SUPPRIMER mon compte<i class="material-icons right">send</i></button>
        </form>
        <?= $_SESSION['giveAdmin'] ?>
        <?= $_SESSION['deleteSmn'] ?>
    </div>
</div>