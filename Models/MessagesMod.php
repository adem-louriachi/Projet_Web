<?php
class MessagesMod extends Model{
    private $idMsg;
    private $idDis;
    private $dateMsg;
    private $textMsg;
    private $stateMsg;
    private $authors;

    public function __construct($idDis, $textMsg, $authors) {
        $this->idDis = $idDis;
        $this->textMsg = $textMsg;
        $this->authors = $authors;
        $this->stateMsg = true;
    }

    public function getIdMsg() { return $this->idMsg; }

    public static function getState($idMsg) {
        $pdo = Model::connectBD();
        $sqlmsgBD = 'SELECT EstOuvert FROM Message WHERE IdMessage = \''.$idMsg.'\'';
        $msgBD =Model::executeQuery($pdo, $sqlmsgBD);
        return $msgBD['EstOuvert'];
    }

    public static function getAllMessage($idDis) {
        $pdo = Model::connectBD();

        $sql = 'SELECT IdMessage FROM Message WHERE IdDisDuMsg =\'' . $idDis . '\'';
        $resultat = $pdo->prepare($sql);
        $resultat->execute();
        while ($row = $resultat->fetch()) {
            $allID [] = $row['TextSection'];
        }
        return $allID;
    }

    public static function getTxt($idMsg) {
        $pdo = Model::ConnectBD();
        $message = '';
        $sqlmsgBD = 'SELECT TextSection FROM SectionMessage WHERE IdMessage = \''.$idMsg.'\' ORDER BY Date ASC';
        $resultat = $pdo->prepare($sqlmsgBD);
        $resultat->execute();
        while ($row = $resultat->fetch()) {
            $message = $message.' '.$row['TextSection'];
        }
        return $message;
    }

    public function getDateMsg() {
        $pdo = Model::connectBD();
        $sql = 'SELECT Date FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
        $dateMsgBD = Model::executeQuery($pdo,$sql);
        $this->dateMsg = $dateMsgBD['Date'];
        return $this->dateMsg;
    }


    public function getIdAuthorsForMsg($author, $idMsg) {
        $pdo = Model::connectBD();
        $sql = 'SELECT Auteur FROM SectionMessage WHERE IdMessage = \''.$idMsg.'\' AND Auteur = \''.$author.'\'';
        $authors = Model::executeQuery($pdo,$sql);
        return $authors['Auteur'];
    }

    public static function closeMsg($idMsg) {
        $pdo = Model::connectBD();
        $sql = 'UPDATE Message SET EstOuvert = 0 WHERE IdMessage = \''.$idMsg.'\'';
        Model::executeQuery($pdo,$sql);
    }

    public static function countSection($idMsg) {
        $pdo = Model::connectBD();
        $sql = 'SELECT count(*) AS NbSection FROM SectionMessage WHERE IdMessage =\''.$idMsg.'\'';
        $nbSection = Model::executeQuery($pdo,$sql);
        return $nbSection['NbSection'];
    }

    public static function insertMsg($idDis) {
        $pdo = Model::connectBD();
        $sql = 'INSERT INTO Message (IdDisDuMsg, EstOuvert) VALUES (\''.$idDis.'\' , 1)';
        Model::executeQuery($pdo, $sql);
    }

    public static function insertSectionMsg($idMsg, $author, $textWord) {
        $pdo = Model::connectBD();
        $sql = 'INSERT INTO SectionMessage (IdMessage, Auteur, TextSection) VALUES (\''.$idMsg.'\',\''.$author.'\', \''.addcslashes($textWord,'\'').'\')';
        Model::executeQuery($pdo, $sql);

    }


//    public function insertMsg() {
//        $pdo = Model::connectBD();
//        $sql = 'INSERT INTO Message (IdDisDuMsg, EstOuvert, TextMessage) VALUES ('.$this->idDis.', 1, \'Text mis dans SectionMessage\')';
//        Model::executeQuery($pdo,$sql);
//        $sqlRecupIdMessage = 'SELECT IdMessage FROM Message ORDER BY IdMessage DESC';
//        $idMsgBD = Model::executeQuery($pdo,$sqlRecupIdMessage);
//        $this->idMsg = $idMsgBD['IdMessage'];
//        $this->dateMsg = $this->getDateMsg();
//        $this->stateMsg = true;
//        $this->addSectionMessage($this->authors, $this->idMsg,$this->textMsg);
//    }

    public function updateMsg($idMsg, $author, $textMsg, $stateMsg) {
        try{
            $pdo = Model::connectBD();
            if(self::getIdAuthorsForMsg($author, $idMsg)){
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } elseif (!self::getState($idMsg)){
                throw new Exception('Impossible d\'ecrire dans un message cloturé');
            } else {
                self::addSectionMessage($author, $idMsg,$textMsg);
                $sql = 'UPDATE Message SET EstOuvert = \'' . $stateMsg . '\', Date = \'' . date('Y-m-d H:i:s') . '\' WHERE IdMessage = \'' . $idMsg. '\'';
                Model::executeQuery($pdo, $sql);
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }



    public function deleteMsg($idMsg) {
        $pdo = Model::connectBD();
        $sqlAuthor = 'DELETE FROM SectionMessage WHERE IdMessage = \''.$idMsg.'\'';
        Model::executeQuery($pdo,$sqlAuthor);
        $sql = 'DELETE FROM Message WHERE IdMessage = \''.$idMsg.'\'';
        Model::executeQuery($pdo,$sql);
    }
}