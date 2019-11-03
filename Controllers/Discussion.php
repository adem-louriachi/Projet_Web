<?php


class Discussion
{

    public static function show()
    { // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        require 'Models/DiscussionsMod.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $idDis = $_GET['id'];
        $allIdMsg = MessagesMod::getAllMessage($idDis);
        $maxIdMsg = 0;

        echo '<h2>' . DiscussionsMod::getName($idDis) .'</h2>';

        foreach ($allIdMsg as $idMsg['IdMessage'] => $id) {
            if ($id['IdMessage'] > $maxIdMsg) { $maxIdMsg = $id['IdMessage']; }
            ?>
            <article>
                <p><? self::butDeleteMsg($id['IdMessage']); echo MessagesMod::getAuthorsForMsg($id['IdMessage'])?> : <? echo MessagesMod::getTxt($id['IdMessage']); ?></p>
            </article>
        <?php }

        ?>

        <?php
        if (User::isConnected()) {
            ?>
            <form id="register" method="post" action="">
                <input name="message" type="text" placeholder="Message...">
                <button name = "msg" class="submit btn waves-effect waves-light" type="submit">Envoyer<i
                            class="material-icons right">send</i></button>
                <button name="new" class="submit btn waves-effect waves-light" type="submit">Nouveau Message<i
                            class="material-icons right">close</i><i class="material-icons right">send</i></button>
            </form>
            <?php
            if (isset($_POST['msg']) && isset($_POST['message']) && !empty($_POST['message'])) {
                if (MessagesMod::getState($maxIdMsg) == 1) { //vérifie si le msg est ouvert
                    MessagesMod::updateMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                } else {
                    MessagesMod::insertMsg($idDis);
                    $maxIdMsg = MessagesMod::getLastMessage($idDis);
                    MessagesMod::insertSectionMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                    header('refresh: 1');
                }
            } elseif (isset($_POST['new']) && isset($_POST['message']) && !empty($_POST['message'])){
                MessagesMod::closeMsg($maxIdMsg);
                MessagesMod::insertMsg($idDis);
                $maxIdMsg = MessagesMod::getLastMessage($idDis);
                MessagesMod::insertSectionMsg($maxIdMsg, $_SESSION['nick'], $_POST['message']);
                header('refresh: 1');
            }
        }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }

    public static function butDeleteMsg($idMsg){
        if (User::isConnected() && $_SESSION['admin'] == 1) {
            ?>
            <form id="discussion" method="post" action="">
                <button name="deleteMsg" class="submit btn waves-effect waves-light left" type="submit"><i
                            class="material-icons">close</i></button>
            </form>
            <?php
        }
        if (isset($_POST['deleteMsg'])) {
            MessagesMod::deleteMsg($idMsg);
            header('refresh: 1');
        }
    }


    public static function newDiscussion()
    { //ajoute une discussion
        require 'AccountMenu.php';
        require 'Models/DiscussionsMod.php';
        $style = 'Views/HomeView.css';
        ob_start();
        ?>
        <h2>Ajout d'une discussion</h2>
        <form id="discussion" method="post" action="">
            <label>Nom de la discussion</label>
            <input name="nomDis" type="text" placeholder="Nom">
            <button class="submit btn waves-effect waves-light" type="submit">Ajouter<i
                        class="material-icons right">send</i></button>
        </form>
        <?php
        if (isset($_POST['nomDis']) AND !empty($_POST['nomDis']) AND User::isConnected()) {
            $nomDis = htmlspecialchars($_POST['nomDis']);
            $idUser = UsersMod::getIdByNick($_SESSION['nick']);
            DiscussionsMod::insertDiscussion($idUser, $nomDis);
            $idNewDis = DiscussionsMod::selectNewDis();
            header("location: /?ctrl=Discussion&action=show&id=$idNewDis");
        }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';
    }

}
