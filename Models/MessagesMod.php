    <?php
    require 'Model.php';
    require 'Controllers/Messages.php';

    class MessagesMod extends Model{
        private $idMsg;    // autoincremente lors de l'ajout dans la BD
        private $idDis;    // id discussion a qui appartient msg
        private $dateMsg;  // current_timestamp dans BD
        private $textMsg;
        private $stateMsg; // bool
        private $authors;

        public function getTextMsg(){
            $pdo = Model::connectBD();
            $sql = 'SELECT TextMessage FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            $this->textMsg = Model::executeQuery($pdo,$sql);

            return $this->textMsg;
        }


        public function getAuthors(){
            $pdo = Model::connectBD();
            $sql = 'SELECT IdUtilisateur FROM Auteur WHERE IdMessage = \''.$this->idMsg.'\'';
            $this->authors = Model::executeQuery($pdo,$sql);

            return $this->authors;
        }


        public function getIdMsg()
        {
            return $this->idMsg;
        }


        public function getDateMsg()
        {
            $pdo = Model::connectBD();
            $sql = 'SELECT Date FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            $this->dateMsg = Model::executeQuery($pdo,$sql);
            return $this->dateMsg;
        }



        public function insertMsg($author, $idDis, $textMsg, $stateMsg){ // Inection SQL possible ???
            $pdo = Model::connectBD();
            $sql = 'INSERT INTO Message (IdDiscussion, TextMessage, EstOuvert) VALUES (\''.$idDis.'\', \''.$textMsg.'\', \''.$stateMsg.'\')';
            Model::executeQuery($pdo,$sql);

            $sqlAuthors = 'INSERT INTO Auteur (IdUtilisateur, IdMessage) VALUES (\''.$author.'\', \''.$this->getIdMsg().'\')';
            Model::executeQuery($pdo,$sqlAuthors);
        }

        public function updateMsg($author, $idDis, $textMsg, $stateMsg){ // Verifier que date se mets a jour
            if($author == $this->getAuthors()){
                throw new Exception('Vous avez deja ecrit dans ce message, impossible de réecrire dans ce dernier');
            } else {
                $pdo = Model::connectBD();
                $textMsg = $this->getTextMsg() . $textMsg;
                $sql = 'UPDATE Message SET IdDiscussion = \'' . $idDis . '\', TextMessage = \'' . $textMsg . '\', EstOuvert = \'' . $stateMsg . '\' WHERE IdMessage = \'' . $this->idMsg . '\'';
                Model::executeQuery($pdo, $sql);
            }
        }


        public function closeMsg(){
            $pdo = Model::connectBD();
            $sql = 'UPDATE Message SET EstOuvert = 0 WHERE IdMessage = \''.$this->idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }

        public function supprMsg(){
            $pdo = Model::connectBD();
            $sql = 'DELETE FROM Message WHERE IdMessage = \''.$this->idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }


    }
