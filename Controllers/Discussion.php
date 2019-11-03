<?php


class Discussion{

    public static function show(){ // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/MessagesMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $idDis = $_GET['id'];
        $allIdMsg = MessagesMod::getAllMessage($idDis);
        $maxIdMsg = 0;
        foreach($allIdMsg as $idMsg['IdMessage'] => $id) {
            if ($id['IdMessage'] > $maxIdMsg) { $maxIdMsg = $id['IdMessage']; ?>
            <article>
                <p><? echo MessagesMod::getTxt($id['IdMessage']); ?></p>
            </article>
        <?php   } ?>

        <?php /*
        while ( $idMsg = $allIdMsg->fetch()) {
            if ($idMsg['IdMessage'] > $maxIdMsg) { $maxIdMsg = $idMsg['IdMessage']; } //obtenir le plus grand idMessage (le dernier) ?>
            <article>
                <p><? echo MessagesMod::getTxt($idMsg['IdMessage']); ?></p>
            </article>
        <?php } */ ?>


        <?php
            if(User::isConnected())
            {
        ?>
            <form id="register" method="post" action="" >
                <input name="message" type="text" placeholder="Message...">
                <button class="submit btn waves-effect waves-light" type="submit">Envoyer<i
                        class="material-icons right">send</i></button>
            </form>
        <?php
                if (MessagesMod::getState($maxIdMsg) == 1) { //vérifie si le msg est ouvert

                    if (isset($_POST['message']) && !empty($_POST['message'])) {
                        MessagesMod::insertSectionMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                        if (MessagesMod::countSection($maxIdMsg) == 3 ) { //nouveau message quand le dernier est plein
                            MessagesMod::closeMsg($maxIdMsg);
                            MessagesMod::insertMsg($idDis);
                        }
                        header('refresh: 1');
                    }
                }
            }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
