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

        public function getTxt($idMsg){
            $pdo = Model::connectBD();

            $sqlmsgBD = 'SELECT TextMessage FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            $msgBD =Model::executeQuery($pdo, $sqlmsgBD);

            return $msgBD;
        }

        public function getState($idMsg){
            $pdo = Model::connectBD();

            $sqlmsgBD = 'SELECT EstOuvert FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            $msgBD =Model::executeQuery($pdo, $sqlmsgBD);
            echo $msgBD;

            return $msgBD;
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

        public function getIdMsg()
        {
            $pdo = Model::connectBD();
            $sql = 'SELECT IdMessage FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            $idMsgBD = Model::executeQuery($pdo,$sql);
            $this->idMsg = $idMsgBD['IdMessage'];

            return $this->idMsg;
        }


        public function getIdDisMsg($idMsg){
            $pdo = Model::connectBD();
            $sql = 'SELECT IdDisDuMsg FROM Message WHERE IdMessage = \''.$idMsg.'\'';
            $idDisMsgBD = Model::executeQuery($pdo,$sql);
            $this->idDis = $idDisMsgBD['IdDisDuMsg'];
            return $this->idDis;
        }


        public function getTextMsg(){
            $pdo = Model::connectBD();
            $sql = 'SELECT TextMessage FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            $textMsgBD = Model::executeQuery($pdo,$sql);
            $this->textMsg = $textMsgBD['TextMessage'];
            return $this->textMsg;
        }


        public function addAuthor($idAuthor, $idMsg)
        {
            $pdo = Model::connectBD();
            $sqlAuthors = 'INSERT INTO Auteur (IdUtilisateur, IdMessage) VALUES (\''.$idAuthor.'\', \''.$idMsg.'\')';
            Model::executeQuery($pdo,$sqlAuthors);
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


        public function updateMsg($idMsg, $author, $textMsg, $stateMsg){
            $pdo = Model::connectBD();
            $sqlSearchAuthor = 'SELECT IdUtilisateur FROM Auteur WHERE IdMessage = \''.$idMsg.'\' AND IdUtilisateur = \''.$idMsg.'\'';
            Model::executeQuery($pdo, $sqlSearchAuthor);

            //test getState()
            self::getState($idMsg);

            if(self::getIdAuthorsForMsg($author, $idMsg)){
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } else
            if (self::getState($idMsg) == 0){
                throw new Exception('Impossible d\'ecrire dans un message cloturé');
            } else {
                $msgBD = self::getTxt($idMsg);



                $textMsg =$msgBD['TextMessage'] . ' ' . $textMsg;

                $sql = 'UPDATE Message SET TextMessage = \'' . $textMsg . '\', EstOuvert = \'' . $stateMsg . '\', Date = \'' . date('Y-m-d H:i:s') . '\' WHERE IdMessage = \'' . $idMsg. '\'';
                Model::executeQuery($pdo, $sql);


                self::addAuthor($author, $idMsg);
            }
        }

        public function supprMsg(){
            $pdo = Model::connectBD();
            $sql = 'DELETE FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }


        public function closeMsg(){
            $pdo = Model::connectBD();
            $sql = 'UPDATE Message SET EstOuvert = 0 WHERE IdMessage = \''.$this->idMsg.'\'';
            Model::executeQuery($pdo,$sql);
            $this->stateMsg = false;
        }



    }
