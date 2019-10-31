<?php

class DiscussionsMod
{
    private $name;
    private $owner;
    private $status;

    public function __construct($c_name, $c_owner)
    {
        $this->name = $c_name;
        $this->owner = $c_owner;
        $pdo = ConnectBD();
        $pdo->query("INSERT INTO Discussion (NomDiscussion, Createur, EstOuvert) VALUES ($c_name, $c_owner, '1')");
    }

    public function GetName()
    {
        return $this->name;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function GetStatus()
    {
        return $this->status;
    }


    public function GetOwner()
    {
        return $this->owner;
    }

    function createDiscussion($name, $author)
    {



    }

}
