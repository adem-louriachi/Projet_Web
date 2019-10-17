<?php
    require 'LinkBD.php';

    function createUser($nick, $email, $pwd) {
        $createUser = ConnectBD()->query("insert into Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) values ($nick,$email,$pwd)");
        return $createUser;
    }

    function getPwdBD($nick) {
        $pwdBD = ConnectBD()->query("select MotDePasse from Utilisateurs where Nom = $nick");
        return $pwdBD;
    }

