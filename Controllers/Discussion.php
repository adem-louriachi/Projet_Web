<?php


class Discussion
{

    public static function show()
    { // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/MessagesMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $idDis = $_GET['id'];
        $allIdMsg = MessagesMod::getAllMessage($idDis);
        $maxIdMsg = 0;
        foreach ($allIdMsg as $idMsg['IdMessage'] => $id) {
            if ($id['IdMessage'] > $maxIdMsg) { $maxIdMsg = $id['IdMessage']; }?>
                <article>
                    <p><? echo MessagesMod::getAuthorsForMsg($id['IdMessage'])?> : <? echo MessagesMod::getTxt($id['IdMessage']); ?></p>
                </article>
        <?php } ?>

        <?php
        if (User::isConnected()) {
            ?>
            <form id="register" method="post" action="">
                <input name="message" type="text" placeholder="Message...">
                <button class="submit btn waves-effect waves-light" type="submit">Envoyer<i
                            class="material-icons right">send</i></button>
                <button name="close"class="submit btn waves-effect waves-light" type="submit">Fermer<i
                            class="material-icons right">Fermer</i></button>
            </form>
            <?php
            if (isset($_POST['message']) && !empty($_POST['message'])) {
                if (MessagesMod::getState($maxIdMsg) == 1) { //vérifie si le msg est ouvert
                    MessagesMod::updateMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                } else {
                    MessagesMod::insertMsg($idDis);
                    $maxIdMsg = MessagesMod::getLastMessage($idDis);
                    MessagesMod::insertSectionMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                }
                header('refresh: 1');
            } elseif (isset($_POST['close'])){
                MessagesMod::closeMsg($maxIdMsg);
            }
        }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
