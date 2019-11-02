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

    public function show(){ // affiche la discussion qu'on lui donne
        require 'AccountMenu.php';
        $style = 'Views/HomeView.css';
        ob_start();

        $id = $_GET['id'];
        while ( $msg = MessagesMod::getAllMessage($id)->fetch()) {?>
            <p><?= DiscussionsMod::getTxt($msg)?></p>
        <?php }

        $content = ob_get_clean();
        require 'Views/TemplateView.php';

    }
}
