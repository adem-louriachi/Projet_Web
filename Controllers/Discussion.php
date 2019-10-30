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
    $message1 = array('Je ne', 'crois pas', 'que ça', 'puisse marcher'); // peut-être mettre un array à la place de chaque message pour inclure l'auteur du message
    $message2 = array('Mais qui', 'ne tente', 'rien', 'n\'a rien');
    $message3 = array('Après tout', 'ce projet', 'sert aussi', 'à apprendre');
    $message4 = array('Vaut mieux', 'que l\'on', 'fasse des', 'erreurs maintenant');
    $message5 = array('qu\'on ne', 'referra pas', 'en stage');
    $message6 = array('Wow cette', 'discussion est', 'franchement pas', 'mal');
    $discussion = array($message1, $message2,$message3,$message4,$message5,$message6);
    foreach ($discussion as $message)
        echo '<br>';
        foreach ($message as $part): ?>
        <article>
            <a class="discussion">
                <p><?= $part.' ' ?></p>
            </a>
        </article>
        <hr/>
        <?php // mettre un deuxième endforeach affiche une erreur sur PHPStorm, bizarre
    endforeach;
    }
}
