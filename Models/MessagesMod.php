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

        public function InsertMsg(){
            $pdo = Model::connectBD();
            $sql = 'INSERT INTO Message (IdDisDuMsg, TextMessage, EstOuvert) VALUES (\''.$this->idDis.'\', \''.$this->textMessage.'\', 1)';
            Model::executeQuery($pdo,$sql);

            $sqlRecupIdMessage = 'SELECT IdMessage FROM Message ORDER BY IdMessage DESC';
            $idMsgBD = Model::executeQuery($pdo,$sqlRecupIdMessage);
            $this->addAuthor($this->authors);


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


        public function getIdDisMsg(){
            $pdo = Model::connectBD();
            $sql = 'SELECT IdDisDuMsg FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
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


        public function getIdAuthors(){
            $pdo = Model::connectBD();
            $sql = 'SELECT IdUtilisateur FROM Auteur WHERE IdMessage = \''.$this->idMsg.'\'';
            $this->authors = Model::executeQuery($pdo,$sql);

            return $this->authors;
        }

        public function addAuthor($idAuthor)
        {
            $pdo = Model::connectBD();
            $sqlAuthors = 'INSERT INTO Auteur (IdUtilisateur, IdMessage) VALUES (\''.$idAuthor.'\', \''.$this->getIdMsg().'\')';
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


        public function updateMsg($idMsg, $author, $textMsg, $stateMsg){ // Verifier que date se mets a jour
           /* if($author == $this->getAuthors()){
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } else */
            if (!$stateMsg){
                throw new Exception('Impossible d\'ecrire dans un message cloturé');
            } else {
                $pdo = Model::connectBD();

                $sqlmsgBD = 'SELECT * FROM Message WHERE IdMessage = \''.$idMsg.'\'';
                $msgBD =Model::executeQuery($pdo, $sqlmsgBD);


                $message = new MessagesMod($sqlmsgBD['IdDisDuMsg'], $sqlmsgBD['TextMessage'], $sqlmsgBD['author']);
                $textMsg =$msgBD->getTextMsg() . ' ' . $textMsg;

                $sql = 'UPDATE Message SET TextMessage = \'' . $textMsg . '\', EstOuvert = \'' . $stateMsg . '\' WHERE IdMessage = \'' . $message->idMsg. '\'';
                Model::executeQuery($pdo, $sql);


                self::addAuthor($author);
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
