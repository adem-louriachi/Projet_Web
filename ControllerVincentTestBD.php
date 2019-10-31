<?php

//    require 'Models/MessagesMod.php';
//    require 'Models/UsersMod.php';
    require 'Models/DiscussionsMod.php';
    require 'Models/GameTestDB/LoadGameTestDB.php';

    if (isset($_POST['idDis']) && isset($_POST['Message']) && isset($_POST['author'])) {
        $idDis   = $_POST['idDis'];
        $textMsg = $_POST['Message'];
        $author  = $_POST['author'];

        $message = new MessagesMod($idDis, $textMsg, $author);
        $message->insertMsg();
        $texte =  $message->getTxt($message->getIdMsg());
        echo $texte.'<br/>';

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

        $user = new UsersMod($nom, $mail, $pwd);
        $user->insertUser();

        $data = $user->getProperties();

        $id    = $user->getId();
        $nom   = $user->getNick();
        $mail  = $user->getMail();
        $pwd   = $user->getPwd();
        $admin = $user->getAdmin();
        $dateI = $user->getDate();

        echo $id .'<br/>'.$nom .'<br/>'.$mail .'<br/>'.$pwd .'<br/>'.$admin .'<br/>'.$dateI .'<br/>';

    } elseif (isset($_POST['Identifiant']) && isset($_POST['Pwd'])) {
        $identifiant   = $_POST['Identifiant'];
        $pwd  = $_POST['Pwd'];

        if(UsersMod::testLoginPwd($_POST['Identifiant'], $_POST['Pwd'])){
            echo 'connexion reussi';
        }

    } elseif (isset($_POST['Mail']) && isset($_POST['ForgetMDP'])) {
        $mail   = $_POST['Mail'];
        $newPwd = UsersMod::forgetPwd($mail);
        echo $newPwd;

    } elseif (isset($_POST['NomDisCreer']) && isset($_POST['Createur']) && isset($_POST['CreateDiscussion'])) {
        $NomDis   = $_POST['NomDisCreer'];
        $Creator  = $_POST['Createur'];

        $discussion = new DiscussionsMod($NomDis, $Creator);
        $discussion->insertDiscussion();
        $data = $discussion->getProperties();
        echo $data['IdDiscussion'] . '<br/>' .
             $data['EstOuvert'] . '<br/>' .
             $data['Createur'] . '<br/>' .
             $data['NomDiscussion'] . '<br/>';

        $discussion->closeDiscussion();

    } elseif (isset($_POST['DisAFermer']) && isset($_POST['CloseDis'])) {
        $idDis   = $_POST['DisAFermer'];

        $discussion = DiscussionsMod::selectDiscussion($idDis);
        $discussion->closeDiscussion();
        
    } else{
        echo 'erreur';
    }