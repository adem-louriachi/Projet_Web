<?php

require 'Model.php';

class UsersMod extends Model
{
    private $id;
    private $nick;
    private $mail;
    private $pwd;
    private $admin;
    private $date;

    public function __construct($c_nick, $c_mail, $c_pwd) {
        $this->nick = $c_nick;
        $this->mail = $c_mail;
        $this->pwd = $c_pwd;

    }

    public function insertUser(){
        if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$this->mail)) {
            throw new Exception('Format de l\'email entré invalide');
        } else {
            $pdo = Model::connectBD();
            $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) 
                    VALUES (\''.$this->nick.'\',\''.$this->mail.'\',\''.password_hash($this->pwd,PASSWORD_BCRYPT).'\', 0)';
            echo $sql;
            Model::executeQuery($pdo,$sql);

            $sql = 'SELECT * FROM Utilisateurs WHERE Nom = \''.$this->nick.'\'';
            $dataUser = Model::executeQuery($pdo,$sql);

            $this->id    = $dataUser['IdUtilisateur'];
            $this->nick  = $dataUser['Nom'];
            $this->mail  = $dataUser['Mail'];
            $this->pwd   = $dataUser['MotDePasse'];
            $this->admin = $dataUser['SuperUtilisateur'];
            $this->date  = $dataUser['DateInscription'];
        }
    }

    public function getProperties()
    {
        $pdo = Model::connectBD();
        $sql = 'SELECT * FROM Utilisateurs WHERE IdUtilisateur := :id';
        $data = Model::executeQuery($pdo,$sql);
        return $data;

    }



    public function getId($idUser)
    {
        $data = self::getProperties($idUser);
        return $data['IdUtilisateur'];
    }


    public function getMail($idUser)
    {
        $data =  self::getProperties($idUser);
        return $data['Mail'];

    }

    public function setMail($idUser, $mail)
    {
        if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$mail)) {
            throw new Exception('Format de l\'email entré invalide');
        } else {
            $pdo = ConnectBD();
            $sql = 'UPDATE Utilisateurs SET Mail = \''.$mail.'\' WHERE IdUtilisateur = \''.$idUser.'\'';
            Model::executeQuery($pdo, $sql);
        }
    }

    public function getPwd($idUser)
    {
        $data = self::getProperties($idUser);
        return $data['MotDePasse'];
    }

    public function setPwd($idUser, $newPwd)
    {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET MotDePasse = \''.password_hash($newPwd,PASSWORD_BCRYPT).'\' WHERE IdUtilisateur = \''.$idUser.'\'';
        Model::executeQuery($pdo, $sql);
        $this->pwd = $newPwd;
    }

    public function getNick($idUser)
    {
        $data = self::getProperties($idUser);
        return $data['Nom'];
    }

    public function getAdmin($idUser)
    {
        $data = self::getProperties($idUser);
        return $data['SuperUtilisateur'];
    }

    public function setAdmin($idUser, $admin)
    {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET SuperUtilisateur = \''.$admin.'\' WHERE IdUtilisateur = \''.$idUser.'\'';
        Model::executeQuery($pdo, $sql);
        $this->admin = $admin;
    }

    function forgetPwd($idUser)
    {
        $newPwd = uniqid(); //mot de passe aléatoire
        self::setPwd($idUser, $newPwd);
        return $newPwd;
    }

    public function getDate($idUser)
    {
        $data = self::getProperties($idUser);
        return $data['DateInscription'];
    }

}












