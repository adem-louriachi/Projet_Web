<?php
//    require '../Model.php';

    class GameTest extends Model {
        public function loadGameTest() {
            $pdo = Model::connectBD();
            //$sql = 'DELETE FROM Auteur; DELETE FROM Message; DELETE FROM Discussion; DELETE FROM Utilisateurs;';
            $sql = 'DELETE FROM Utilisateurs;';
            Model::executeQuery($pdo, $sql);

            $utilisateurDataFile = 'GameTestDB/UtilisateurDB.json';
            $utilisateurData = file_get_contents($utilisateurDataFile);
            $utilisateurArray = json_decode($utilisateurData, true);
            foreach ($utilisateurArray as $row) {
                $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, IdUtilisateur, DateInscription) 
                        VALUES (\'' . $row['Nom'] . '\', \'' . $row['Mail'] . '\', \'' . $row['MotDePasse'] . '\', \'' . $row['SuperUtilisateur'] . '\', \'' . $row['IdUtilisateur'] . '\', \'' . $row['DateInscription'] . '\')';
                Model::executeQuery($pdo, $sql);
            }
        }
    }