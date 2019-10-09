<?php
class Membre
{
    private $mail;
    private $mdp;
    private $pseudo;
    private $admin = false;

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function __construct($_mail,$_mdp, $_pseudo) {
        $this->setMail($_mail);
        $this->setMdp($_mdp);
        $this->setPseudo($_pseudo);
    }

    public function __destruct()
    {

    }
}