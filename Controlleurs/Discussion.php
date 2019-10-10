<?php

class Discussion{
    private $name;
    private $owner;
    private $status;

    public function __construct($c_name, $c_owner){
        $this->name = $c_name;
        $this->owner = $c_owner;
        $this->statut = False;
    }

    public function GetStatus(){
        return $this->status;
    }

    public function GetName(){
        return $this->name;
    }

    public function GetOwner(){
        return $this->owner;
    }
}
