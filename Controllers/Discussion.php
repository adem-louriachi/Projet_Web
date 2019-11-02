<?php


class Discussion{

    public static function show(){ // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/MessagesMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $id = $_GET['id'];
        $allIdMsg = MessagesMod::getAllMessage($id);
        $maxIdMsg = 0;
        while ($idMsg = $allIdMsg->fetch()) {//obtenir le plus grand idMessage
            if ($idMsg > $maxIdMsg) { $maxIdMsg = $idMsg; }
        }?>
        <form id="register" method="post" action="<? MessagesMod::insertSectionMsg($maxIdMsg, $_SESSION['user'], $_POST['message']) ?> >" >
            <input name="message" type="text" placeholder="Message...">
            <button class="submit btn waves-effect waves-light" type="submit">Envoyer<i
                        class="material-icons right">send</i></button>
        </form>
        <?php
        while ( $idMsg = $allIdMsg->fetch()) { ?>
            <article>
                <p><? echo MessagesMod::getTxt($idMsg['IdMessage']); ?></p>
            </article>
        <?php }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
