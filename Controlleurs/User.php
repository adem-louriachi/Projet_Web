<?php
require('../Models/UsersMod.php');

class User
{
    private $mail;
    private $pwd;
    private $name;
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

    public function getName()
    {
        return $this->name; //requete pour recup dans la BD
    }

    public function setName($name)
    {
        $this->name = $name; //requete pour update dans la BD
    }

    public function getAdmin()
    {
        return $this->admin; //requete pour recup dans la BD
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin; //requete pour update dans la BD
    }

    public function __construct($_mail,$_pwd, $_name) {
        $this->setMail($_mail); //requete pour insérer dans la BD
        $this->setPwd($_pwd); //requete pour insérer dans la BD
        $this->setName($_name); //requete pour insérer dans la BD
    }

    public function __destruct()
    {

    }
}

?>
