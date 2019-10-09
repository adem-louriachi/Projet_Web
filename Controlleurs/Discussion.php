<?php

class Discussion{
    private $nom;
    private $proprio;
    private $statut;

    public function __construct($name, $proprie){
        $this->nom = $name;
        $this->proprio = $proprie;
        $this->statut = False;
    }

    public function recupStatus(){
        return $this->statut;
    }

    public function recupNom(){
        return $this->nom;
    }

    public function recupProprio(){
        return $this->proprio;
    }
}