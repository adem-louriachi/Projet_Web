<?php
    function createDiscussion($name,$author) {

        $pdo = ConnectBD();
        $pdo->query("INSERT INTO Discussion (NomDiscussion, Createur, EstOuvert) VALUES ($name, $author, '1')");

    }

