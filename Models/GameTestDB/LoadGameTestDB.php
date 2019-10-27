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
            $discussionData = file_get_contents( __DIR__.'/DiscussionDB.json');
            $discussionArray = json_decode($discussionData, true);
            foreach ($discussionArray as $row) {
                $sql = 'INSERT INTO Discussion (IdDiscussion, EstOuvert, Createur, NomDiscussion) 
                        VALUES (\'' . $row['IdDiscussion'] . '\', \'' . $row['EstOuvert'] . '\', \'' . $row['Createur'] . '\', \'' . $row['NomDiscussion'] . '\')';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des messages
            $msgData = file_get_contents( __DIR__.'/MessageDB.json');
            $msgArray = json_decode($msgData, true);
            foreach ($msgArray as $row) {
                $sql = 'INSERT INTO Message (IdMessage, IdDisDuMsg, TextMessage, Date, EstOuvert) 
                        VALUES (\'' . $row['IdMessage'] . '\', \'' . $row['IdDisDuMsg'] . '\', \'' . $row['TextMessage'] . '\', \'' . $row['Date'] . '\', \'' . $row['EstOuvert'] . '\')';
                Model::executeQuery($pdo,$sql);
            }

            $sqlTest = 'SELECT MAX(LENGTH(TextMessage)) AS LongueurTxt FROM Message';
            $nb = Model::executeQuery($pdo,$sqlTest);
            echo '<br/><br/><br/><br/>'.$nb['LongueurTxt'];
        }
    }