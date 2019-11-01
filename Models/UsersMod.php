<?php

require 'Model.php';

class UsersMod extends Model {

    public static function testLoginPwd($identifiant, $pwd) {
        try {
            $pdo = Model::connectBD();
            if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $identifiant)) { // verifie si $nick est de la forme d'un mail
                $sql = 'SELECT * FROM Utilisateurs WHERE Mail = \'' . $identifiant . '\'';
            } else {
                $sql = 'SELECT * FROM Utilisateurs WHERE Nom = \'' . $identifiant . '\'';
            }
            $data = Model::executeQuery($pdo, $sql);
            if (empty($data)) {
                throw new Exception('Identifiant incorrect');
            } else if (!password_verify($pwd, $data['MotDePasse'])) {
                throw new Exception('Mot de passe incorrect');
            }
            return true;
        } catch (Exception $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public static function signin($nick) {
        $pdo = Model::connectBD();
        if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $nick)) {  // verifie si $nick est de la forme d'un mail
            $sql = 'SELECT * FROM Utilisateurs WHERE Mail = \'' . $nick . '\'';
        } else {
            $sql = 'SELECT * FROM Utilisateurs WHERE Nom = \'' . $nick . '\'';
        }
        $data = Model::executeQuery($pdo,$sql);
        return $data;
    }


    public static function insertUser($c_nick, $c_mail, $c_pwd) {
        if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $c_mail)) {
            $_POST['error'] = 'Format de l\'email entré invalide';
            header('Location: /?ctrl=Form&action=register');
        } else {
            $pdo = Model::connectBD();
            $sql = 'SELECT Nom FROM Utilisateurs WHERE Nom = \'' . $c_nick . '\' ';
            if (Model::executeQuery($pdo, $sql)['Nom'] == $c_nick){
                $_POST['error'] = 'Pseudo déjà utilisé';
                header('Location: /?ctrl=Form&action=register');
            } else {
                $sql = 'SELECT Mail FROM Utilisateurs WHERE Mail = \'' . $c_mail . '\' ';
                if (Model::executeQuery($pdo, $sql)['Mail'] == $c_mail){
                    $_POST['error'] = 'Email déjà utilisé';
                    header('Location: /?ctrl=Form&action=register');
                } else {
                    $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) 
                        VALUES (\'' . $c_nick . '\',\'' . $c_mail . '\',\'' . password_hash($c_pwd, PASSWORD_BCRYPT) . '\', 0)';
                    Model::executeQuery($pdo, $sql);
                    $_SESSION['nick'] = $c_nick;
                    $_SESSION['email'] = $c_mail;
                    $_SESSION['admin'] = 0;
                    $_SESSION['date'] = self::getDate($c_nick);
                }
            }
        }
    }

    public static function deleteUser($c_nick) {
        try {
            $pdo = Model::connectBD();
            $sql = 'SELECT IdUtilisateur FROM Utilisateurs WHERE Nom = \'' . $c_nick . '\' ';
            $dataUser = Model::executeQuery($pdo, $sql);

            // IdUtilisateur = 2 correspond à l'Utilisateur Ex-membre
            $sql = 'UPDATE Discussion SET Createur = 2 WHERE Createur = \''.$dataUser['IdUtilisateur'].'\'';
            Model::executeQuery($pdo, $sql);

            $sql = 'UPDATE SectionMessage SET Auteur = 2 WHERE Auteur = \''.$dataUser['IdUtilisateur'].'\'';
            Model::executeQuery($pdo, $sql);

            $sql = 'DELETE FROM Utilisateurs WHERE IdUtilisateur = \''.$dataUser['IdUtilisateur'].'\'  ';
            Model::executeQuery($pdo, $sql);

        } catch (Exception $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public static function setMail($idUser, $mail) {
        try {
            if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$mail)) {
                throw new Exception('Format de l\'email entré invalide');
            } else {
                $pdo = ConnectBD();
                $sql = 'UPDATE Utilisateurs SET Mail = \''.$mail.'\' WHERE IdUtilisateur = \''.$idUser.'\'';
                Model::executeQuery($pdo, $sql);
            }
        } catch (Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public static function setPwd($idUser, $newPwd) {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET MotDePasse = \''.password_hash($newPwd,PASSWORD_BCRYPT).'\' WHERE IdUtilisateur = \''.$idUser.'\'';
        Model::executeQuery($pdo, $sql);
    }

    public static function setAdmin($idUser, $admin) {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET SuperUtilisateur = \''.$admin.'\' WHERE IdUtilisateur = \''.$idUser.'\'';
        Model::executeQuery($pdo, $sql);
    }

    public function getDate($c_nick){
        $pdo = Model::connectBD();
        $sql = 'SELECT DateInscription FROM Utilisateurs WHERE Nom = \'' . $c_nick . '\' ';
        $dataUser = Model::executeQuery($pdo, $sql);
        return $dataUser['DateInscription'];
    }

    public static function forgetPwd($mail) {
        //generation mot de passe aléatoire
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $newPwd = '';

        for ($i = 0; $i < 24; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $newPwd .= $characters[$index];
        }

        for ($i = 0; $i < 5; $i++) {
            for ($i = 0; $i < strlen($newPwd)-1; $i++) {
                if ( (is_int($newPwd[$i])&& is_int($newPwd[$i+1]))) {
                    $newPwd[$i] = random_int(0,9);
                    $newPwd[random_int(0,strlen($newPwd)-1)] = random_int(0,9);
                }
            }
        }
        //fin generation mot de passe aléatoire

        try {
            if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$mail)) {
                throw new Exception('Format de l\'email entré invalide');
            }

            $pdo = Model::ConnectBD();
            $sql = 'SELECT * FROM Utilisateurs WHERE Mail = \''.$mail.'\'';
            $data = Model::executeQuery($pdo, $sql);

            if (empty($data)) {
                throw new Exception('Mail inexistant');
            }
            $sql = 'UPDATE Utilisateurs SET MotDePasse = \''.password_hash($newPwd,PASSWORD_BCRYPT).'\' WHERE Mail = \''.$mail.'\'';
            Model::executeQuery($pdo, $sql);
            return $newPwd;
        } catch (Exception $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }
}