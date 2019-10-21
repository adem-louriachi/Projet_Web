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


    public function executeQuery($pdo, $sql, $cond = null) {
        if ($cond == null) {
            $resultat = $pdo->query($sql);   // exécution directe
        }
        else {
            $resultat = $pdo->prepare($sql); // requête préparée
            $resultat->execute($cond);
        }
        return $resultat;
    }
}
