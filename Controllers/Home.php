<?php
    require 'AccountMenu.php';
    ob_start();
    $style = 'Views/HomeView.css';
?>
<div class="center green-text"><?=$_SESSION['success']?></div>
<div class="center white-text indigo welcome">
    <h2>Description du site</h2>
        <p>
        Bienvenue sur FreeNote ! <br> Un réseau social où les messages privés n'existent pas. <br>
        Vous pouvez lancer une discussion sur un sujet (La mort de Jacques Chirac, Pourquoi il ne faut pas boire de Munster, L'utilité d'un BDE, Greta Thunberg, etc.).
        Puis, vous, cher.ère.s membres, pouvez participer à chaque discussion. <br>
        Cependant, nous ne sommes pas ici pour créer un basique forum. Chacun de vous ne peut écrire que deux mots dans un message sur toute une discussion ET C'EST TOUT. <br>
        Choisissez vos mots avec soin...
        </p>
</div>
<div class="row">
    <div class="col s6 right-align">
   <? echo '<form id="GameTestForm" method="post" action="">
                <button name = "LoadGameTest" class="waves-effect waves-light btn" type="submit">Charger GameTest</button>
            </form>';


   if (isset($_POST['LoadGameTest'])) {
       require 'Models/GameTestDB/LoadGameTestDB.php';
       GameTest::loadGameTest();
   } ?>
   </div>
    <div class="col s6">
    <?php
        require 'Models/DiscussionsMod.php';

        if (User::isConnected()) { ?>
        <a class="waves-effect waves-light btn" href="/?ctrl=Discussion&action=newDiscussion"><i class="material-icons right">add</i>Ajouter une nouvelle discussion</a>
        <?php } ?>
    </div>
</div>
<div class="discussion collection container">
<?php
$allDis = DiscussionsMod::getAllDiscussion();
foreach ($allDis as $dis) { ?>
    <article>
        <a href="/?ctrl=Discussion&action=show&id=<?= $dis['IdDiscussion'] ?>" class="discussion collection-item active">
            <h3 class="center-align"><?= $dis['NomDiscussion']; ?></h3>
            <p class="left-align"><? echo UsersMod::getNickById($dis['Createur']); ?></p>
            <p class="left-align"><? if($dis['EstOuvert'] == 0) { echo 'Fermé'; } else { echo 'Ouvert'; } ?></p>
        </a>
    </article>
    <?php } ?>


    <?php /*

$allDis = DiscussionsMod::getAllDiscussion();
while ($dis = $allDis->fetch()) { ?>
    <article>
        <a href="/?ctrl=Discussion&action=show&id=<?= $dis['IdDiscussion'] ?>" class="discussion collection-item active">
            <h3 class="center-align"><?= $dis['NomDiscussion']; ?></h3>
            <p class="left-align"><?= $dis['Createur']; ?></p>
            <p class="left-align"><? if($dis['EstOuvert'] == 0) { echo 'Fermé'; } else { echo 'Ouvert'; } ?></p>
        </a>
    </article>
<?php } ?>
    */ ?>

</div>
<?php
    $content = ob_get_clean();
    require 'Views/TemplateView.php';
    if (isset($_SESSION['success'])) unset($_SESSION['success']);
?>
