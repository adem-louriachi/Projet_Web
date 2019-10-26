<?php
require 'UtilisateurDB.json';

    class GameTest extends Model {
        public function loadGameTest() {
            $pdo = Model::connectBD();
            //$sql = 'DELETE FROM Auteur; DELETE FROM Message; DELETE FROM Discussion; DELETE FROM Utilisateurs;';
            $sql = 'DELETE FROM Utilisateurs;';
            try {
                $resultat = $pdo->prepare($sql); // requête préparée
                $resultat->execute();
                echo $sql . '<br/>';
            } catch (PDOException $e) {
                // Affichage de l'erreur
                echo 'Erreur : ', $e->getMessage(), PHP_EOL;
                echo 'Requete en faute : ', $sql, PHP_EOL;
            }

            $utilisateurDataFile = 'UtilisateurDB.json';
            $utilisateurData = file_get_contents($utilisateurDataFile);
            $utilisateurArray = json_decode($utilisateurData, true);
            foreach ($utilisateurArray as $row) {
                $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, IdUtilisateur, DateInscription) 
                        VALUES (\'' . $row['Nom'] . '\', \'' . $row['Mail'] . '\', \'' . $row['MotDePasse'] . '\', \'' . $row['SuperUtilisateur'] . '\', \'' . $row['IdUtilisateur'] . '\', \'' . $row['DateInscription'] . '\')';
                try {
                    $resultat = $pdo->prepare($sql); // requête préparée
                    $resultat->execute();
                    echo $sql . '<br/>';
                } catch (PDOException $e) {
                    // Affichage de l'erreur
                    echo 'Erreur : ', $e->getMessage(), PHP_EOL;
                    echo 'Requete en faute : ', $sql, PHP_EOL;
                }
            }
        }
    }