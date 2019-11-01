<?php
    require 'AuthenticationCheck.php';
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
$discussion1 = array('nick' => 'Paul', 'contenu' => 'Cookies 🍪');
$discussion2 = array('nick' => 'Adem', 'contenu' => 'Materialize vie');
$discussion3 = array('nick' => 'Guillaume', 'contenu' => 'Le PHP');
$discussion4 = array('nick' => 'Vincent', 'contenu' => 'La BD');
$discussion5 = array('nick' => 'Toto', 'contenu' => 'wow');
$discussion6 = array('nick' => 'Paul', 'contenu' => 'Autoload magie');
$discussions = array($discussion1, $discussion2,$discussion3,$discussion4,$discussion5,$discussion6);
foreach ($discussions as $discussion): ?>
    <article>
        <a href="#!" class="discussion collection-item active">
            <h3 class="center-align"><?= $discussion['nick'] ?></h3>
            <p class="left-align"><?= $discussion['contenu'] ?></p>
            <a href="#!" class="secondary-content"><i class="material-icons">arrow-forward</i></a>
        </a>
    </article>
<?php endforeach; ?>
</div>
<?php
    $content = ob_get_clean();
    require 'Views/TemplateView.php';
?>
