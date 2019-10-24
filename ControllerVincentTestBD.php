<?php

    require 'Models/MessagesMod.php';

    // Gestion Auteur pas verifier

    if (isset($_POST['idDis']) && isset($_POST['Message']) && isset($_POST['author'])) {
        $idDis   = $_POST['idDis'];
        $textMsg = $_POST['Message'];
        $author = $_POST['author'];

        $message = new MessagesMod($idDis, $textMsg, $author);
        echo $message->getTextMsg();  // objet class MessagesMod could not converted to string  Faire fonction Show()
    }
    else{
        echo 'erreur';
    }