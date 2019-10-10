<?php
require('../Models/UsersMod.php');

class User
{
    private $mail;
    private $pwd;
    private $nick;
    private $admin;

    public function __construct($_mail,$_pwd, $_nick) {
        $this->setMail($_mail);
        $this->setPwd($_pwd);
        $this->setName($_nick);
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }


}

?>
