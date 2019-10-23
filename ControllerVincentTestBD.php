<?php

require 'Models/MessagesMod.php';

// Gestion Auteur pas verifier

    if (isset($_POST['idDis']) && isset($_POST['Message']) && isset($_POST['stateMsg']) /* && isset($_POST['author']) */ ) {
        $idDis   = $_POST['idDis'];
        $textMsg = $_POST['Message'];
        $state   = $_POST['stateMsg'];

        $message = new MessagesMod()
    }
    else{
        echo 'erreur';
    }