<?php
    require 'LinkBD.php';

    function createUser($nick, $email, $pwd) {

        $pdo = ConnectBD();
        $pdo->query("INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) VALUES ($nick,$email,md5($pwd), '0')");

    }

    function getPwdBD($nick) {

        $pdo = ConnectBD();
        $pwd = $pdo->query("SELECT MotDePasse FROM Utilisateurs WHERE Nom = $nick");
        return $pwd;

    }

    function setPwdBd($nick, $newPwd) {

        $pdo = ConnectBD();
        $pdo->query("UPDATE Utilisateurs SET MotDePasse = md5($newPwd) WHERE Nom = $nick");

    }

    function forgetPwd($nick) {

        $newPwd = uniqid();
        setPwdBd($nick, $newPwd);
        return $newPwd;
    }





