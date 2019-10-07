<?php
    class Utilisateur{
        private $nom;
        private $email;
        private $su;  // bool superutilisateur

        public function __construct($name){
            $this->nom = $name;
        }
        public function estConnecte(){
            if(isset($this->nom)){
                return True;
            }
            return False;
        }

        public function estSU(){
            return $this->su;
        }

        public function recupNom(){
            return $this->nom;
        }

        public function recupEmail(){
            return $this->email;
        }
    }