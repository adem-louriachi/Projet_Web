<?php

    //require 'Models/MessagesMod.php';
    require 'Models/UsersMod.php';
    require 'Models/GameTestDB/LoadGameTestDB.php';

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

    } elseif (isset($_POST['idMsgS'])){
        $idMsg   = $_POST['idMsgS'];
        MessagesMod::deleteMsg($idMsg);
    } elseif (isset($_POST['GameTestDB'])) {
        GameTest::loadGameTest();
    } elseif (isset($_POST['TestUserBD']) && isset($_POST['idUser'])) {
        $id    = UsersMod::getId($_POST['idUser']);
        $nom   = UsersMod::getNick($_POST['idUser']);
        $mail  = UsersMod::getMail($_POST['idUser']);
        $pwd   = UsersMod::getPwd($_POST['idUser']);
        $admin = UsersMod::getAdmin($_POST['idUser']);
        $dateI = UsersMod::getDate($_POST['idUser']);

        echo $id .'<br/>'.$nom .'<br/>'.$mail .'<br/>'.$pwd .'<br/>'.$admin .'<br/>'.$dateI .'<br/>';
    } elseif (isset($_POST['Nom']) && isset($_POST['Mail']) && isset($_POST['Mdp']) && isset($_POST['UserAdd'])) {
        $nom   = $_POST['Nom'];
        $mail = $_POST['Mail'];
        $pwd  = $_POST['Mdp'];

        $message = new UsersMod($nom, $mail, $pwd);
        $message->insertUser();

        $data = $message->getProperties();

        $id    = $message->getId();
        $nom   = $message->getNick();
        $mail  = $message->getMail();
        $pwd   = $message->getPwd();
        $admin = $message->getAdmin();
        $dateI = $message->getDate();

        echo $id .'<br/>'.$nom .'<br/>'.$mail .'<br/>'.$pwd .'<br/>'.$admin .'<br/>'.$dateI .'<br/>';

    } else{
        echo 'erreur';
    }