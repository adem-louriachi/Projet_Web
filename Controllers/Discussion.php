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
        while ( $idMsg = $allIdMsg->fetch()) {
            if ($idMsg > $maxIdMsg) { $maxIdMsg = $idMsg; } //obtenir le plus grand idMessage (le dernier) ?>
            <article>
                <p><? echo MessagesMod::getTxt($idMsg['IdMessage']); ?></p>
            </article>
        <?php }
            if(User::isConnected())
            {
        ?>
            <form id="register" method="post" action="<? MessagesMod::insertSectionMsg($idDis, $maxIdMsg, $_SESSION['user'], $_POST['message']) ?> >" >
                <input name="message" type="text" placeholder="Message...">
                <button class="submit btn waves-effect waves-light" type="submit">Envoyer<i
                        class="material-icons right">send</i></button>
            </form>
        <?php }
        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
