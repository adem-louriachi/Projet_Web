    <?php
    require 'Model.php';
//    require 'Controllers/Messages.php';

    class MessagesMod extends Model{
        private $idMsg;    // autoincremente lors de l'ajout dans la BD
        private $idDis;    // id discussion a qui appartient msg
        private $dateMsg;  // current_timestamp dans BD
        private $textMsg;
        private $stateMsg; // bool
        private $authors;

        public function __construct($idDis, $textMsg, $authors){

            $this->idDis = $idDis;

            $this->textMsg = $textMsg;
            $this->authors = $authors;
            $this->stateMsg = true;
        }

        public function getState($idMsg){
            $pdo = Model::connectBD();

            $sqlmsgBD = 'SELECT EstOuvert FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            $msgBD =Model::executeQuery($pdo, $sqlmsgBD);

            return $msgBD['EstOuvert'];
        }

        public function getTxt($idMsg){
            $pdo = Model::connectBD();

            $sqlmsgBD = 'SELECT TextMessage FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            $msgBD =Model::executeQuery($pdo, $sqlmsgBD);

            return $msgBD;
        }

        public function getDateMsg()
        {
            $pdo = Model::connectBD();
            $sql = 'SELECT Date FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            $dateMsgBD = Model::executeQuery($pdo,$sql);
            $this->dateMsg = $dateMsgBD['Date'];
            return $this->dateMsg;
        }


        public function getIdAuthorsForMsg($author, $idMsg){
            $pdo = Model::connectBD();
            $sql = 'SELECT IdUtilisateur FROM Auteur WHERE IdMessage = \''.$idMsg.'\' AND IdUtilisateur = \''.$author.'\'';
            $authors = Model::executeQuery($pdo,$sql);

            return $authors;
        }

        public function addAuthor($idAuthor, $idMsg)
        {
            $pdo = Model::connectBD();
            $sqlAuthors = 'INSERT INTO Auteur (IdUtilisateur, IdMessage) VALUES (\''.$idAuthor.'\', \''.$idMsg.'\')';
            Model::executeQuery($pdo,$sqlAuthors);
        }

        public function InsertMsg(){
            $pdo = Model::connectBD();
            $sql = 'INSERT INTO Message (IdDisDuMsg, TextMessage, EstOuvert) VALUES (\''.$this->idDis.'\', \''.$this->textMessage.'\', 1)';
            Model::executeQuery($pdo,$sql);

            $sqlRecupIdMessage = 'SELECT IdMessage FROM Message ORDER BY IdMessage DESC';
            $idMsgBD = Model::executeQuery($pdo,$sqlRecupIdMessage);
            $this->addAuthor($this->authors, $this->idMsg);


            $this->idMsg = $idMsgBD['IdMessage'];
            $this->dateMsg = $this->getDateMsg();
            $this->stateMsg = true;
        }

        public function updateMsg($idMsg, $author, $textMsg, $stateMsg){
            $pdo = Model::connectBD();
            $sqlSearchAuthor = 'SELECT IdUtilisateur FROM Auteur WHERE IdMessage = \''.$idMsg.'\' AND IdUtilisateur = \''.$idMsg.'\'';
            Model::executeQuery($pdo, $sqlSearchAuthor);

            if(self::getIdAuthorsForMsg($author, $idMsg)){
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } elseif (!self::getState($idMsg)){
                throw new Exception('Impossible d\'ecrire dans un message cloturé');
            } else {
                $msgBD = self::getTxt($idMsg);
                $textMsg =$msgBD['TextMessage'] . ' ' . $textMsg;

                $sql = 'UPDATE Message SET TextMessage = \'' . $textMsg . '\', EstOuvert = \'' . $stateMsg . '\', Date = \'' . date('Y-m-d H:i:s') . '\' WHERE IdMessage = \'' . $idMsg. '\'';
                Model::executeQuery($pdo, $sql);

                self::addAuthor($author, $idMsg);
            }
        }

        public function closeMsg($idMsg){
            $pdo = Model::connectBD();
            $sql = 'UPDATE Message SET EstOuvert = 0 WHERE IdMessage = \''.$idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }

        public function deleteMsg($idMsg){
            $pdo = Model::connectBD();
            $sqlAuthor = 'DELETE FROM Auteur WHERE IdMessage = \''.$idMsg.'\'';
            Model::executeQuery($pdo,$sqlAuthor);

            $sql = 'DELETE FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }
    }