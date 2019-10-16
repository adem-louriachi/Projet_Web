<?php
    require 'LinkBD.php';

    function createUser($nick, $email, $pwd) {
        $createUser = ConnectBD()->query("insert into Utilisateurs(nom, mail, MotDePasse, SuperUtilisateur) values ('$nick','$email','$pwd')");
        return $createUser;
    }

