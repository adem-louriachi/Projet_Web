<?php

    require 'Models/MessagesMod.php';

    // Gestion Auteur pas verifier

    if (isset($_POST['idDis']) && isset($_POST['Message']) && isset($_POST['author'])) {
        $idDis   = $_POST['idDis'];
        $textMsg = $_POST['Message'];
        $author  = $_POST['author'];

        $message = new MessagesMod($idDis, $textMsg, $author);
        $message->InsertMsg();
        echo $message->getTextMsg();  // objet class MessagesMod could not converted to string  Faire fonction Show()
        
    }elseif (isset($_POST['idMsg']) && isset($_POST['MessageU']) && isset($_POST['authorU']) && isset($_POST['etatU'])){
        $idMsg   = $_POST['idMsg'];
        $textMsg = $_POST['MessageU'];
        $author  = $_POST['authorU'];
        $state   = $_POST['etatU'];
        MessagesMod::updateMsg($idMsg, $author, $textMsg, $state);

    } elseif (isset($_POST['idMsgC'])){
        $idMsg   = $_POST['idMsgC'];
        MessagesMod::closeMsg($idMsg);

    }  elseif (isset($_POST['idMsgS'])){
        $idMsg   = $_POST['idMsgS'];
        MessagesMod::deleteMsg($idMsg);
    } else{
        echo 'erreur';
    }