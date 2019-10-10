<?php
require('../Models/UsersMod.php');

class User
{
    private $mail;
    private $pwd;
    private $nick;
    private $admin;

    public function getMail()
    {
        return $this->mail; //requete pour recup dans la BD
    }

    public function setMail($mail)
    {
        $this->mail = $mail; //requete pour update dans la BD
    }

    public function getPwd()
    {
        return $this->pwd; //requete pour recup dans la BD
    }

    public function setPwd($pwd)
    {
        $this->pwd = $pwd; //requete pour update dans la BD
    }

    public function getNick()
    {
        return $this->nick; //requete pour recup dans la BD
    }

    public function setNick($nick)
    {
        $this->nick = $nick; //requete pour update dans la BD
    }

    public function getAdmin()
    {
        return $this->admin; //requete pour recup dans la BD
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin; //requete pour update dans la BD
    }

    public function __construct($_mail,$_pwd, $_nick) {
        $this->setMail($_mail); //requete pour insérer dans la BD
        $this->setPwd($_pwd); //requete pour insérer dans la BD
        $this->setName($_nick); //requete pour insérer dans la BD
    }

    public function __destruct()
    {

    }
}

?>
