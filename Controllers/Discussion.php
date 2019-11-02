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
            <article>
                <p><? echo MessagesMod::getTxt($idMsg); ?></p>
            </article>
        <?php }

        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
