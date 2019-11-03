<?php

    class GameTest extends Model {
        public static function loadGameTest() {
            $pdo = Model::connectBD();
            $sql = 'DELETE FROM SectionMessage';
            Model::executeQuery($pdo,$sql);
            $sql = 'DELETE FROM Message';
            Model::executeQuery($pdo,$sql);
            $sql = 'DELETE FROM Discussion';
            Model::executeQuery($pdo,$sql);
            $sql = 'DELETE FROM Utilisateurs';
            Model::executeQuery($pdo,$sql);

            // Insertion des utilisateurs
            $utilisateurDataFile = __DIR__.'/UtilisateurDB.json';
            $utilisateurData = file_get_contents($utilisateurDataFile);
            $utilisateurArray = json_decode($utilisateurData, true);
            foreach ($utilisateurArray as $row) {
                $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, IdUtilisateur, DateInscription) 
                        VALUES (\'' . addcslashes($row['Nom'],'\'') . '\', \'' . $row['Mail'] . '\', \'' . $row['MotDePasse'] . '\', \'' . $row['SuperUtilisateur'] . '\', \'' . $row['IdUtilisateur'] . '\', \'' . $row['DateInscription'] . '\')';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des discussions
            $discussionData = file_get_contents( __DIR__.'/DiscussionDB.json');
            $discussionArray = json_decode($discussionData, true);
            foreach ($discussionArray as $row) {
                $sql = 'INSERT INTO Discussion (IdDiscussion, EstOuvert, Createur, NomDiscussion) 
                        VALUES (\'' . $row['IdDiscussion'] . '\', \'' . $row['EstOuvert'] . '\', \'' . $row['Createur'] . '\', \'' . addcslashes($row['NomDiscussion'],'\'') . '\')';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des messages
            $msgData = file_get_contents( __DIR__.'/MessageDB.json');
            $msgArray = json_decode($msgData, true);
            foreach ($msgArray as $row) {
                $sql = 'INSERT INTO Message (IdMessage, IdDisDuMsg, Date, EstOuvert) 
                        VALUES (\'' . $row['IdMessage'] . '\', \'' . $row['IdDisDuMsg'] . '\', \'' . $row['Date'] . '\', \'' . $row['EstOuvert'] . '\')';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des sections de messages
            $msgData = file_get_contents( __DIR__.'/SectionMessageDB.json');
            $msgArray = json_decode($msgData, true);
            foreach ($msgArray as $row) {
                $sql = 'INSERT INTO SectionMessage (IdSection, IdMessage, Auteur, TextSection, Date) 
                        VALUES (\'' . $row['IdSection'] . '\', \'' . $row['IdMessage'] . '\', \'' . $row['Auteur'] . '\', \'' . addcslashes($row['TextSection'],'\'') . '\', \'' . $row['Date'] . '\')';
                Model::executeQuery($pdo,$sql);
            }
        }
    }
