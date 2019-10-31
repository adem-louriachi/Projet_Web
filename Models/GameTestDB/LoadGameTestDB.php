<?php

    class GameTest extends Model {
        public function loadGameTest() {
            $pdo = Model::connectBD();
            $sql = 'TRUNCATE TABLE SectionMessage; TRUNCATE TABLE Message; TRUNCATE TABLE Discussion; TRUNCATE TABLE Utilisateurs;';
            Model::executeQuery($pdo,$sql);

            // Insertion des utilisateurs
            $utilisateurDataFile = __DIR__.'/UtilisateurDB.json';
            $utilisateurData = file_get_contents($utilisateurDataFile);
            $utilisateurArray = json_decode($utilisateurData, true);
            foreach ($utilisateurArray as $row) {
                $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, IdUtilisateur, DateInscription) 
                        VALUES (\'' . addcslashes($row['Nom'],'\'') . '\', \'' . $row['Mail'] . '\', \'' . $row['MotDePasse'] . '\', \'' . $row['SuperUtilisateur'] . '\', \'' . $row['IdUtilisateur'] . '\', \'' . $row['DateInscription'] . '\')';
                echo $sql. '<br/>';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des discussions
            $discussionData = file_get_contents( __DIR__.'/DiscussionDB.json');
            $discussionArray = json_decode($discussionData, true);
            foreach ($discussionArray as $row) {
                $sql = 'INSERT INTO Discussion (IdDiscussion, EstOuvert, Createur, NomDiscussion) 
                        VALUES (\'' . $row['IdDiscussion'] . '\', \'' . $row['EstOuvert'] . '\', \'' . $row['Createur'] . '\', \'' . addcslashes($row['NomDiscussion'],'\'') . '\')';
                echo $sql. '<br/>';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des messages
            $msgData = file_get_contents( __DIR__.'/MessageDB.json');
            $msgArray = json_decode($msgData, true);
            foreach ($msgArray as $row) {
                $sql = 'INSERT INTO Message (IdMessage, IdDisDuMsg, Date, EstOuvert) 
                        VALUES (\'' . $row['IdMessage'] . '\', \'' . $row['IdDisDuMsg'] . '\', \'' . $row['Date'] . '\', \'' . $row['EstOuvert'] . '\')';
                echo $sql. '<br/>';
                Model::executeQuery($pdo,$sql);
            }

            // Insertion des sections de messages
            $msgData = file_get_contents( __DIR__.'/SectionMessageDB.json');
            $msgArray = json_decode($msgData, true);
            foreach ($msgArray as $row) {
                $sql = 'INSERT INTO Message (IdSection, IdMessage, Auteur, TextSection, Date) 
                        VALUES (\'' . $row['IdSection'] . '\', \'' . $row['IdMessage'] . '\', \'' . $row['Auteur'] . '\', \'' . addcslashes($row['TextSection'],'\'') . '\', \'' . $row['Date'] . '\')';
                echo $sql. '<br/>';
                Model::executeQuery($pdo,$sql);
            }
        }
    }