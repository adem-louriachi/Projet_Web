<?php
    require 'LinkBD.php';

    function createUser($nick, $email, $pwd) {

        $pdo = ConnectBD();
        $sql = "INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) VALUES ($nick,$email,$pwd, '0')";


    }

    function getPwdBD($nick) {

        $pdo = ConnectBD();
        $sql = "SELECT MotDePasse FROM Utilisateurs WHERE Nom = $nick";


    }

    function setPwdBd($nick, $newPwd) {

        $pdo = ConnectBD();
        $sql = "UPDATE Utilisateurs SET MotDePasse = $newPwd WHERE Nom = $nick";


    }

    function forgetPwd($nick) {

        $newPwd = uniqid();
        setPwdBd($nick, $newPwd);
        return $newPwd;
    }



