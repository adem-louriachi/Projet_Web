<?php
require('../Modèles/UtilisateursMod.php');

class Utilisateur
{
    private $mail;
    private $mdp;
    private $pseudo;
    private $admin;

    public function getMail()
    {
        return $this->mail; //requete pour recup dans la BD
    }

    public function setMail($mail)
    {
        $this->mail = $mail; //requete pour update dans la BD
    }

    public function getMdp()
    {
        return $this->mdp; //requete pour recup dans la BD
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp; //requete pour update dans la BD
    }

    public function getPseudo()
    {
        return $this->pseudo; //requete pour recup dans la BD
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo; //requete pour update dans la BD
    }

    public function getAdmin()
    {
        return $this->admin; //requete pour recup dans la BD
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin; //requete pour update dans la BD
    }

    public function __construct($_mail,$_mdp, $_pseudo) {
        $this->setMail($_mail); //requete pour insérer dans la BD
        $this->setMdp($_mdp); //requete pour insérer dans la BD
        $this->setPseudo($_pseudo); //requete pour insérer dans la BD
    }

    public function __destruct()
    {

    }
}

?>