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

    public function testLoginPwd($identifiant, $pwd)
    {
        try {
            $pdo = Model::connectBD();
            if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $identifiant)) {
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


    public function insertUser(){
        if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$this->mail)) {
            throw new Exception('Format de l\'email entré invalide');
        } else {
            $pdo = Model::connectBD();
            $sql = 'INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur) 
                    VALUES (\''.$this->nick.'\',\''.$this->mail.'\',\''.password_hash($this->pwd,PASSWORD_BCRYPT).'\', 0)';
            Model::executeQuery($pdo,$sql);

            $sql = 'SELECT * FROM Utilisateurs WHERE Nom = \''.$this->nick.'\'';
            $dataUser = Model::executeQuery($pdo,$sql);

            $this->id    = $dataUser['IdUtilisateur'];
            $this->nick  = $dataUser['Nom'];
            $this->mail  = $dataUser['Mail'];
            $this->pwd   = $dataUser['MotDePasse'];
            $this->admin = $dataUser['SuperUtilisateur'];
            $this->date  = $dataUser['DateInscription'];

            echo $this->id ;
        }
    }

    public function getProperties()
    {
        $data = [
            'IdUtilisateur' => $this->id,
            'Nom' => $this->nick,
            'Mail' => $this->mail,
            'MotDePasse' => $this->pwd,
            'SuperUtilisateur' => $this->admin,
            'DateInscription' => $this->date,
        ];
        return $data;
    }



    public function getId()
    {
        $data = $this->getProperties();
        return $data['IdUtilisateur'];
    }


    public function getMail()
    {
        $data =  $this->getProperties();
        return $data['Mail'];

    }

    public function setMail($mail)
    {
        if(!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',$mail)) {
            throw new Exception('Format de l\'email entré invalide');
        } else {
            $pdo = ConnectBD();
            $sql = 'UPDATE Utilisateurs SET Mail = \''.$mail.'\' WHERE IdUtilisateur = \''.$this->id.'\'';
            Model::executeQuery($pdo, $sql);
        }
    }

    public function getPwd()
    {
        $data = $this->getProperties();
        return $data['MotDePasse']; // Password en bcrypt pour verifier log utiliser  password_verify ( $mdp_entrer_par_user , $mdpBD ) : bool
    }

    public function setPwd($newPwd)
    {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET MotDePasse = \''.password_hash($newPwd,PASSWORD_BCRYPT).'\' WHERE IdUtilisateur = \''.$this->id.'\'';
        Model::executeQuery($pdo, $sql);
        $this->pwd = $newPwd;
    }

    public function getNick()
    {
        $data = $this->getProperties();
        return $data['Nom'];
    }

    public function getAdmin()
    {
        $data = $this->getProperties();
        return $data['SuperUtilisateur'];
    }

    public function setAdmin($admin)
    {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET SuperUtilisateur = \''.$admin.'\' WHERE IdUtilisateur = \''.$this->id.'\'';
        Model::executeQuery($pdo, $sql);
        $this->admin = $admin;
    }

    function forgetPwd($mail)
    {
        //generation mot de passe aléatoire
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $newPwd = '';

        for ($i = 0; $i < 24; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $newPwd .= $characters[$index];
        }

        for ($i = 0; $i < 5; $i++) {
            for ($i = 0; $i < strlen($newPwd)-1; $i++) {
                if ( (is_int($newPwd[$i])&& is_int($newPwd[$i+1]))){
                    $newPwd[$i] = random_int(0,9);
                    $newPwd[random_int(0,strlen($newPwd)-1)] = random_int(0,9);
                }
            }
        }
        //fin generation mot de passe aléatoire

        try{
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
        } catch (Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public function getDate()
    {
        $data = $this->getProperties();
        return $data['DateInscription'];
    }

}












