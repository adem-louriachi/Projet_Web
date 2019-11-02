<?php


class Discussion{

    public static function show(){ // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/MessagesMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $id = $_GET['id'];
        $allMsg = MessagesMod::getAllMessage($id);
        while ( $idMsg = $allMsg->fetch()) { ?>
            <p><?= MessagesMod::getTxt($idMsg)?></p>
        <?php }

        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
