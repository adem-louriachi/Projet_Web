<?php

// A voir pour MVC   https://tutowebdesign.com/mvc-php.php
abstract class Model
{
    public function connectBD()
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


    public function executeQuery($pdo, $sql, $cond = NULL) {
        try {
            $resultat = $pdo->prepare($sql); // requête préparée
            $resultat->execute($cond);
            $row = $resultat->fetch();
            return $row;
        } catch (PDOException $e) {
            // Affichage de l'erreur
            echo 'Erreur : ', $e->getMessage(), PHP_EOL;
            echo 'Requete en faute : ', $sql, PHP_EOL;
        }
    }


}
