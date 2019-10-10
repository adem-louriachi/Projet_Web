<?php
require('../Models/MessagesMod.php');

class Messages
{
    private $msgdate;
    private $authors;
    private $status;

    public function getMsgdate()
    {
        return $this->msgdate; //requete pour recup dans la BD
    }


    public function getAuthors()
    {
        return $this->authors; //requete pour recup dans la BD
    }

    public function setAuthors(User $authors)
    {
        $this->authors = $authors; //requete pour insert dans la BD
    }

    public function getStatus()
    {
        return $this->status; //requete pour recup dans la BD
    }

    public function setStatus($status)
    {
        $this->status = $status; //requete pour update dans la BD
    }

    public function __construct()
    {

    }
}
