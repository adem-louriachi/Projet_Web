<?php

function ConnectBD()
{
    try {
        // Connexion à la base de donnee
        $dsn = 'mysql:host=mysql-freenote-4randoms.alwaysdata.net;dbname=freenote-4randoms_bd';
        $pdo = new PDO($dsn, '191395', 'les4randoms');
        return $pdo;

    } catch (PDOException $e) {
        // Affichage de l'erreur
        die ('Erreur :'. $e->getMessage());
    }

}
