<?php
class MessagesMod extends Model {
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
        $allID = $resultat->fetchAll();
        return $allID;
    }

    public static function getLastMessage($idDis) {
        $pdo = Model::connectBD();

        $sql = 'SELECT IdMessage FROM Message WHERE IdDisDuMsg =\'' . $idDis . '\' ORDER BY Date DESC LIMIT 0,1';
        $idLastMsg =Model::executeQuery($pdo, $sql);
        return $idLastMsg['IdMessage'];
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


    public static function getAuthorsForMsg($idMsg) {
        $pdo = Model::connectBD();
        $authors = '';
        $sql = 'SELECT Auteur FROM SectionMessage WHERE IdMessage = \''.$idMsg.'\'';
        $resultat = $pdo->prepare($sql);
        $resultat->execute();
        while ($row = $resultat->fetch()) {
            $nomUser = UsersMod::getNickById($row['Auteur']);
            $authors = $authors . $nomUser . ' | ';
        }
        return $authors;
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


    public static function updateMsg($idMsg, $author, $textMsg) {
        try {
            $pdo = Model::connectBD();
            $textMsg = self::quote_smart($textMsg);
            $msg = explode(' ', $textMsg);
            if(self::getIdAuthorsForMsg($author, $idMsg)) {
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } elseif (!self::getState($idMsg)) {
                throw new Exception('Impossible d\'ecrire dans un message cloturé');
            }elseif (isset($msg[2])){
                throw new Exception('Votre message ne doit contenir que 2 mots maximum');
            } elseif (!preg_match('[0-9a-zA-Z\s]{1,53}', $textMsg)){
                throw new Exception('Votre message ne doit pas contenir de ponctuations ou de caractères spéciaux et faire 53 caractères au maximum ( pour éviter les abus )');
            } else {
                self::insertSectionMsg($idMsg,$author,$textMsg);
                $sql = 'UPDATE Message SET Date = \'' . date('Y-m-d H:i:s') . '\' WHERE IdMessage = \'' . $idMsg. '\'';
                Model::executeQuery($pdo, $sql);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /*
    * Fonction qui protège la variable passée en paramètre des injections SQL
    * et des caractères spéciaux.
    *
    * @author Mickaël Martin Nevot
    */
    public static function quote_smart($value) {
        $value = utf8_encode($value);
        // Protection concernant Stripslashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Protection si ce n'est pas une valeur numérique ou une chaîne numérique
        if (!is_numeric($value)) {
            $value = '\'' . mysql_real_escape_string($value) . '\'';
        }
        return $value;
    }

    public static function deleteMsg($idMsg) {
        $pdo = Model::connectBD();
        $sqlAuthor = 'DELETE FROM SectionMessage WHERE IdMessage = \''.$idMsg.'\'';
        Model::executeQuery($pdo,$sqlAuthor);
        $sql = 'DELETE FROM Message WHERE IdMessage = \''.$idMsg.'\'';
        Model::executeQuery($pdo,$sql);
    }
}