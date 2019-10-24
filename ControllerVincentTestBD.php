<?php

    require 'Models/MessagesMod.php';

    // Gestion Auteur pas verifier

    if (isset($_POST['idDis']) && isset($_POST['Message']) && isset($_POST['author'])) {
        $idDis   = $_POST['idDis'];
        $textMsg = $_POST['Message'];
        $author  = $_POST['author'];

        $message = new MessagesMod($idDis, $textMsg, $author);
        echo $message->getTextMsg();  // objet class MessagesMod could not converted to string  Faire fonction Show()
    }elseif (isset($_POST['idMsg']) && isset($_POST['MessageU']) && isset($_POST['authorU']) && isset($_POST['etatU'])){
        $idMsg   = $_POST['idMsg'];
        $textMsg = $_POST['Message'];
        $author  = $_POST['author'];
        $state   = $_POST['etatU'];

        MessagesMod::updateMsg($idMsg, $author, $textMsg, $state);
    } else{
        echo 'erreur';
    }