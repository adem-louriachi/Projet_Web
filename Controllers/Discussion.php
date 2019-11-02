<?php


class Discussion{

    public static function show(){ // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/MessagesMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $id = $_GET['id'];
        while ( $idmsg = MessagesMod::getAllMessage($id)->fetch()) {?>
            <p><?= MessagesMod::getTxt($idmsg)?></p>
        <?php }

        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
