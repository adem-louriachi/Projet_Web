<?php
require 'Model.php';
class DiscussionsMod extends Model {
    private $id;
    private $name;
    private $owner;
    private $status;

    public function __construct($c_name, $c_owner) {
        $this->name = $c_name;
        $this->owner = $c_owner;
    }

    public function getName() {
        return $this->name;
    }

    public function setStatus($status) {
        $pdo = ConnectBD();
        $sql = 'UPDATE Utilisateurs SET EstOuvert = \''.$status.'\' WHERE IdDiscussion = \''.$this->id.'\'';
        Model::executeQuery($pdo, $sql);
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }


    public function getOwner() {
        return $this->owner;
    }

    function insertDiscussion() {
        $pdo = Model::connectBD();
        $sql = 'INSERT INTO Discussion(EstOuvert,  Createur, NomDiscussion) 
                    VALUES (1,\''.$this->owner.'\',\''.$this->name.'\')';
        echo $sql. '<br/>';
        Model::executeQuery($pdo,$sql);

        $sql = 'SELECT * FROM Discussion ORDER BY IdDiscussion DESC';
        $dataUser = Model::executeQuery($pdo,$sql);

        $this->id    = $dataUser['IdDiscussion'];
        $this->status  = $dataUser['EstOuvert'];
        $this->owner  = $dataUser['Createur'];
        $this->name   = $dataUser['NomDiscussion'];
    }

    public function closeDiscussion() {
        $pdo = Model::connectBD();
        $sqlmsgBD = 'SELECT IdMessage FROM Message WHERE IdDiscussion = \''.$this->id.'\' ';
        $resultat = $pdo->prepare($sqlmsgBD);
        $resultat->execute();
        while ($row = $resultat->fetch()) {
            MessagesMod::closeMsg($row['IdMessage']);
        }

        $sql = 'UPDATE Discussion SET EstOuvert = 0 WHERE IdDiscussion = \''.$this->id.'\'';
        Model::executeQuery($pdo,$sql);
    }

    public function deleteDiscussion() {
        $pdo = Model::connectBD();
        $sqlmsgBD = 'SELECT IdMessage FROM Message WHERE IdDiscussion = \''.$this->id.'\'';
        $resultat = $pdo->query($sqlmsgBD);
        while ($row = $resultat->fetch()) {
            MessagesMod::deleteMsg($row['IdMessage']);
        }
        $sql = 'DELETE FROM Discussion WHERE IdDiscussion = \''.$this->id.'\'';
        Model::executeQuery($pdo,$sql);
    }


    public function getProperties() {
        $data = [
            'IdDiscussion' => $this->id,
            'EstOuvert' => $this->status,
            'Createur' => $this->owner,
            'NomDiscussion' => $this->name
        ];
        return $data;
    }


}
