<?php

require 'Model.php';

class UsersMod extends Model {

    public static function signin($identifiant, $pwd, $isID) {
        try {
            $pdo = Model::connectBD();
            if ($isID) { // si ce n'est pas un identifiant ( une adresse email )
                $sql = 'SELECT * FROM Utilisateurs WHERE Nom = \'' . $identifiant . '\'';
            } else {
                $sql = 'SELECT * FROM Utilisateurs WHERE Mail = \'' . $identifiant . '\'';
            }
            $data = Model::executeQuery($pdo, $sql);
            if (empty($data)) {
                throw new Exception('Identifiant incorrect');
            } else if (!password_verify($pwd, $data['MotDePasse'])) {
                throw new Exception('Mot de passe incorrect');
            }
            return $data;
        } catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: /?ctrl=Form&action=signin');
        }
    }

    public static function insertUser($c_nick, $c_mail, $c_pwd) {
        try{
            if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $c_mail)) {
                throw new Exception('Format de l\'email entré invalide');
            } else {
                $pdo = Model::connectBD();
                $sql = 'SELECT Nom FROM Utilisateurs WHERE Nom = \'' . $c_nick . '\' ';
                if (Model::executeQuery($pdo, $sql)['Nom'] == $c_nick){
                    throw new Exception('Pseudo déjà utilisé');
                } else {
                    $sql = 'SELECT Mail FROM Utilisateurs WHERE Mail = \'' . $c_mail . '\' ';
                    if (Model::executeQuery($pdo, $sql)['Mail'] == $c_mail){
                        throw new Exception('Email déjà utilisé');
                    } else {
                        $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) 
                            VALUES (\'' . $c_nick . '\',\'' . $c_mail . '\',\'' . password_hash($c_pwd, PASSWORD_BCRYPT) . '\', 0)';
                        Model::executeQuery($pdo, $sql);
                        $_SESSION['nick'] = $c_nick;
                        $_SESSION['email'] = $c_mail;
                        $_SESSION['admin'] = 0;
                        $_SESSION['date'] = self::getDate($c_nick);
                        header('Location: /?ctrl=User&action=view');
                    }
                }
            }
        }
        catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: /?ctrl=Form&action=register');
        }
    }

    public static function deleteUser($c_nick) {
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
    }

    public static function setMail($nick, $mail) {
        try {
            if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $mail)) {
                throw new Exception('Format de l\'email entré invalide');
            } else {
                $pdo = Model::ConnectBD();
                $sql = 'UPDATE Utilisateurs SET Mail = \'' . $mail . '\' WHERE Nom = \'' . $nick . '\'';
                Model::executeQuery($pdo, $sql);
                $_SESSION['email'] = $mail;
                $_SESSION['success'] = 'Email changé';
                header('Location: /');
            }
        } catch (Exception $e) {
            $_SESSION['error']['changeEmail'] = $e->getMessage();
            header('Location: /?ctrl=User&action=view');
        }
    }

    public static function setPwd($nick, $newPwd) {
        $pdo = Model::ConnectBD();
        $sql = 'UPDATE Utilisateurs SET MotDePasse = \''.password_hash($newPwd,PASSWORD_BCRYPT).'\' WHERE Nom = \''.$nick.'\'';
        Model::executeQuery($pdo, $sql);
    }

    public static function setAdmin($nick, $admin) {
        $pdo = Model::ConnectBD();
        $sql = 'UPDATE Utilisateurs SET SuperUtilisateur = \''.$admin.'\' WHERE Nom = \''.$nick.'\'';
        Model::executeQuery($pdo, $sql);
    }

    public function getDate($c_nick){
        $pdo = Model::connectBD();
        $sql = 'SELECT DateInscription FROM Utilisateurs WHERE Nom = \'' . $c_nick . '\' ';
        $dataUser = Model::executeQuery($pdo, $sql);
        return $dataUser['DateInscription'];
    }

    public static function forgetPwd($email, $newPwd) {
        try {
            if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $email)) {
                throw new Exception('Format de l\'email entré invalide');
            }

            $pdo = Model::ConnectBD();
            $sql = 'SELECT * FROM Utilisateurs WHERE Mail = \'' . $email . '\'';
            $data = Model::executeQuery($pdo, $sql);

            if (empty($data)) {
                throw new Exception('Mail inexistant');
            }
            $sql = 'UPDATE Utilisateurs SET MotDePasse = \'' . password_hash($newPwd, PASSWORD_BCRYPT) . '\' WHERE Mail = \'' . $email . '\'';
            Model::executeQuery($pdo, $sql);
            $_SESSION['test'] .= 'Mdp changé';
            return true; // ( succès du changement de mot de passe )
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /?ctrl=Form&action=forget');
        }
    }
}