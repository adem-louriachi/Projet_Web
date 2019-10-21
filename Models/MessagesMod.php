    <?php
    require 'Model.php';
    require 'Controllers/Messages.php';

    class MessagesMod extends Model{
        private $idMsg;    // autoincremente lors de l'ajout dans la BD
        private $idDis;    // id discussion a qui appartient msg
        private $dateMsg;  // current_timestamp dans BD
        private $textMsg;
        private $stateMsg; // bool

        public function insertMsg($idDis, $textMsg, $stateMsg){ // Inection SQL possible ???
                $pdo = Model::connectBD();
                $sql = 'INSERT INTO Message (IdDiscussion, TextMessage, Date, EstOuvert) VALUES (\''.$idDis.'\', \''.$textMsg.'\', \''.$stateMsg.'\')';
                Model::executeQuery($pdo,$sql);
        }

        public function closeMsg(){
            $pdo = Model::connectBD();
            $sql = 'UPDATE Message SET EstOuvert = 0 WHERE IdMessage = \''.$this->idMsg.'\'';
            Model::executeQuery($pdo,$sql);
        }


    }

   /* function InsertMsg($IdD, $TextM, $Ouvert){
        $pdo = connectBD();

        $sql = 'INSERT INTO Message (IdDiscussion, TextMessage, Date, EstOuvert)  VALUES (' . $IdD . ', ' . $TextM . ', ' . $Ouvert . ')';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('IdDiscussion', $IdD, PDO::PARAM_INT);
        $stmt->bindValue('TextMessages', $TextM, PDO::PARAM_STR);
        $stmt->bindValue('EstOuvert', $Ouvert, PDO::PARAM_BOOL);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur ', PHP_EOL;
            echo 'Requete : ', $sql, PHP_EOL;
            exit;
        }
      }

   */
