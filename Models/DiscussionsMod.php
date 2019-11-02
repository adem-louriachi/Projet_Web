<?php
//require 'Model.php';
require 'MessagesMod.php';
class DiscussionsMod extends Model {
    private $id;
    private $name;
    private $owner;
    private $status;

    public function __construct($c_name, $c_owner) {
        $this->name = $c_name;
        $this->owner = $c_owner;
        $pdo = Model::ConnectBD();
        $pdo->query("INSERT INTO Discussion (NomDiscussion, Createur, EstOuvert) VALUES ($c_name, $c_owner, '1')");
    }

    public function getName() {
        return $this->name;
    }

    public function setStatus($status) {
        $pdo = Model::ConnectBD();
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
        Model::executeQuery($pdo,$sql);

        $sql = 'SELECT * FROM Discussion ORDER BY IdDiscussion DESC';
        $dataUser = Model::executeQuery($pdo,$sql);

        $this->id    = $dataUser['IdDiscussion'];
        $this->status  = $dataUser['EstOuvert'];
        $this->owner  = $dataUser['Createur'];
        $this->name   = $dataUser['NomDiscussion'];
    }

    function selectDiscussion($idDis) {
        $pdo = Model::connectBD();

        $sql = 'SELECT * FROM Discussion WHERE IdDiscussion = \''.$idDis.'\'';
        $dataUser = Model::executeQuery($pdo,$sql);

        $discussion = new DiscussionsMod($dataUser['NomDiscussion'], $dataUser['Createur']);
        $discussion->id    = $dataUser['IdDiscussion'];
        $discussion->status  = $dataUser['EstOuvert'];

        return $discussion;
    }


    public static function getNbDiscussion() {
        $pdo = Model::connectBD();

        $sql = 'SELECT COUNT(*) AS NbDiscusion FROM Discussion';
        $nbDis = Model::executeQuery($pdo,$sql);
        return $nbDis['NbDiscusion'];
    }

    public static function showNameDis($posInDB) {
        $pdo = Model::connectBD();
        $predDisWant = $posInDB - 1;
        $sql = 'SELECT NomDiscussion FROM Discussion LIMIT '.$predDisWant.', 1';
        $nomDis = Model::executeQuery($pdo,$sql);
        return $nomDis['NomDiscussion'];
    }



    public function closeDiscussion() {
        $pdo = Model::connectBD();
        $sqlmsgBD = 'SELECT IdMessage FROM Message WHERE IdDisDuMsg = \''.$this->id.'\' ';
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
        $sqlmsgBD = 'SELECT IdMessage FROM Message WHERE IdDisDuMsg = '.$this->id.' ORDER BY IdMessage DESC';
        $resultat = $pdo->prepare($sqlmsgBD);
        $resultat->execute();
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