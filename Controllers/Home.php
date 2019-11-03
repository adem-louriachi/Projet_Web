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
   <? echo '<form id="GameTestForm" method="post">
                <button name = "LoadGameTest" class="waves-effect waves-light btn" type="submit">Charger GameTest</button>
            </form>';


   echo '<form id="NbDis" method="post">
              <input type="number" name="howmuch">
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
$limit = (!empty($_POST['howmuch']) ? $_POST['howmuch'] : 2);
$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$allDis = DiscussionsMod::getAllDiscussionLimit($limit, $page);
foreach ($allDis as $dis) { ?>
    <article>
        <a href="/?ctrl=Discussion&action=show&id=<?= $dis['IdDiscussion'] ?>" class="discussion collection-item active">

            <?php
            if (User::isConnected() && $_SESSION['admin'] == 1) {
                ?>
                <form id="deleteDiscussion" method="post" action="">
                    <button name="<?= 'del'.$dis['IdDiscussion'] ?>" class="submit btn waves-effect waves-light right" type="submit"><i
                                class="material-icons">close</i></button>
                </form>
                <?php
                if (isset($_POST['del'.$dis['IdDiscussion']])){
                    DiscussionsMod::deleteDiscussion($dis['IdDiscussion']);
                    unset($_POST['deleteDis']);
                    header('refresh: 1');
                }
            }
            ?>




            <h3 class="center-align"><?= $dis['NomDiscussion']; ?></h3>
            <p class="left-align"><? echo UsersMod::getNickById($dis['Createur']); ?></p>
            <p class="left-align"><? if($dis['EstOuvert'] == 0) { echo 'Fermé'; } else { echo 'Ouvert'; } ?></p>
        </a>
    </article>
    <?php }

    $nombreDePages = ceil(DiscussionsMod::nbElementPagination($limit,$page) / $limit);
    if ($page > 1):
        ?><a class="waves-effect waves-light btn" href="?page=<?php echo $page - 1; ?>"><i class="material-icons left"></i>Page précédente</a><?php
    endif;

    for ($i = 1; $i <= $nombreDePages; $i++):
        ?><a class="waves-effect waves-light btn" href="?page=<?php echo $i; ?>"><i class="material-icons right"></i><?php echo $i; ?></a> <?php
    endfor;
    if ($page < $nombreDePages):
        ?><a class="waves-effect waves-light btn" href="?page=<?php echo $page + 1; ?>"><i class="material-icons right"></i>Page suivante</a><?php
    endif;
    ?>







</div>
<?php
    $content = ob_get_clean();
    require 'Views/TemplateView.php';
    if (isset($_SESSION['success'])) unset($_SESSION['success']);




    