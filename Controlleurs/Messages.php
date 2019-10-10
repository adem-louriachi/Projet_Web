<?php
require('../Modèles/MessagesMod.php');

class Messages
{
    private $datemsg;
    private $auteurs;
    private $status;

    public function getDatemsg()
    {
        return $this->datemsg; //requete pour recup dans la BD
    }


    public function getAuteurs()
    {
        return $this->auteurs; //requete pour recup dans la BD
    }

    public function setAuteurs(Utilisateur $auteurs)
    {
        $this->auteurs = $auteurs; //requete pour insert dans la BD
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
