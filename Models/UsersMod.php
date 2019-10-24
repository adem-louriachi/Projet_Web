<?php

require 'Model.php';

class UsersMod extends Model
{
    private $nick;
    private $mail;
    private $pwd;
    private $admin;
    private $date;

    public function __construct($c_mail, $c_pwd, $c_nick)
    {
        $this->mail = $c_mail;
        $this->pwd = $c_pwd;
        $this->nick = $c_nick;
        $pdo = ConnectBD();
        $pdo->query("INSERT INTO Utilisateurs(Nom, Mail, MotDePasse, SuperUtilisateur, DateInscription) VALUES ($c_nick,$c_mail,md5($c_pwd), '0', date('l j F Y'))");
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $pdo = ConnectBD();
        $pdo->query("UPDATE Utilisateurs SET Mail := $mail) WHERE Nom = $this->nick");
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setPwd($newPwd)
    {
        $pdo = ConnectBD();
        $pdo->query("UPDATE Utilisateurs SET MotDePasse := md5($newPwd) WHERE Nom = $this->nick");
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $pdo = ConnectBD();
        $pdo->query("UPDATE Utilisateurs SET SuperUtilisateur := $admin WHERE Nom = $this->nick");
    }

    function forgetPwd()
    {
        $newPwd = uniqid(); //mot de passe aléatoire
        $pdo = ConnectBD();
        $pdo->query("UPDATE Utilisateurs SET MotDePasse := md5($newPwd) WHERE Nom = $this->nick");
        return $newPwd;
    }

    public function getDate()
    {
        return $this->date;
    }

}












