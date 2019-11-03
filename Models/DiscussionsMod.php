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
    }

    public static function getName($idDis) {
        $pdo = Model::ConnectBD();
        $sql = 'SELECT NomDiscussion FROM Discussion WHERE IdDiscussion = \'' . $idDis . '\'';
        $name = Model::executeQuery($pdo, $sql);
        return $name['NomDiscussion'];
    }

    public static function selectNewDis() {
        $pdo = Model::ConnectBD();
        $sql = 'SELECT MAX(IdDiscussion) AS MaxId FROM Discussion';
        $id = Model::executeQuery($pdo, $sql);
        return $id['MaxId'];
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

    public static function insertDiscussion($createur, $nomDis) {
        try {
            if (self::getNbDiscussion() < 11) {
                $pdo = Model::connectBD();
                $sql = 'INSERT INTO Discussion(EstOuvert,  Createur, NomDiscussion) VALUES (1,\'' . $createur . '\',\'' . $nomDis . '\')';
                Model::executeQuery($pdo, $sql);
            } else {
                throw new Exception('Nombre de discussion maximum atteint');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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

    public static function getAllDiscussion() {
        $pdo = Model::connectBD();

        $sql = 'SELECT * FROM Discussion';
        $resultat = $pdo->prepare($sql);
        $resultat->execute();
        $allDiscussion = $resultat->fetchAll();
        return $allDiscussion;
    }

    public static function getNbDiscussion() {
        $pdo = Model::connectBD();

        $sql = 'SELECT COUNT(*) AS NbDiscussion FROM Discussion';
        $nbDis = Model::executeQuery($pdo,$sql);
        return $nbDis['NbDiscussion'];
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

    public static function deleteDiscussion($idDis) {
        $pdo = Model::connectBD();
        $sqlmsgBD = 'SELECT IdMessage FROM Message WHERE IdDisDuMsg = '.$idDis.' ORDER BY IdMessage DESC';
        $resultat = $pdo->prepare($sqlmsgBD);
        $resultat->execute();
        while ($row = $resultat->fetch()) {
            MessagesMod::deleteMsg($row['IdMessage']);
        }
        $sql = 'DELETE FROM Discussion WHERE IdDiscussion = \''.$idDis.'\'';
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