<?php
    require 'AccountMenu.php';
    ob_start();
    $style = 'Views/HomeView.css';
?>
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
<div class="discussion collection container">
<?php
$allDis = DiscussionsMod::selectAllDiscussion();
while ($dis = $allDis->fetch()) { ?>
    <article>
        <a href="#!" class="discussion collection-item active">
            <h3 class="center-align"><?= $dis['nick'] ?></h3>
            <p class="left-align"><?= $dis['contenu'] ?></p>
            <a href="#!" class="secondary-content"><i class="material-icons">arrow-forward</i></a>
        </a>
    </article>
<?php } ?>
</div>
<?php
    $content = ob_get_clean();
    require 'Views/TemplateView.php';
?>
