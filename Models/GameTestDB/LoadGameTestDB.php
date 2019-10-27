<?php

    class GameTest extends Model {
        public function loadGameTest() {
            $pdo = Model::connectBD();
            $sql = 'DELETE FROM Auteur; DELETE FROM Message; DELETE FROM Discussion; DELETE FROM Utilisateurs;';
            Model::executeQuery($pdo,$sql);

            // Insertion des utilisateurs
            $utilisateurDataFile = __DIR__.'/UtilisateurDB.json';
            $utilisateurData = file_get_contents($utilisateurDataFile);
            $utilisateurArray = json_decode($utilisateurData, true);
            foreach ($utilisateurArray as $row) {
                $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, IdUtilisateur, DateInscription) 
                        VALUES (\'' . $row['Nom'] . '\', \'' . $row['Mail'] . '\', \'' . $row['MotDePasse'] . '\', \'' . $row['SuperUtilisateur'] . '\', \'' . $row['IdUtilisateur'] . '\', \'' . $row['DateInscription'] . '\')';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des discussions
            $discussionData = file_get_contents( __DIR__.'/UtilisateurDB.json');
            $discussionArray = json_decode($discussionData, true);
            foreach ($discussionArray as $row) {
                $sql = 'INSERT INTO Discussion (IdDiscussion, EstOuvert, Createur, NomDiscussion) 
                        VALUES (\'' . $row['IdDiscussion'] . '\', \'' . $row['EstOuvert'] . '\', \'' . $row['Createur'] . '\', \'' . $row['NomDiscussion'] . '\')';
                Model::executeQuery($pdo,$sql);
            }
        }
    }