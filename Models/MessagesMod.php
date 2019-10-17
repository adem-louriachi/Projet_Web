    <?php
    require 'LinkBD.php';
    require 'Controllers/Messages.php';


    function InsertMsg($IdD, $TextM, $Ouvert)
    {
        $pdo = ConnectBD();

        $sql = 'INSERT INTO Message (IdDiscussion, TextMessage, Date, EstOuvert)  VALUES (' . $IdD . ', ' . $TextM . ', ' . $Ouvert . ')';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue('IdDiscussion',$IdD, PDO::PARAM_INT);
        $stmt->bindValue('TextMessages',$TextM, PDO::PARAM_STR);
        $stmt->bindValue('EstOuvert',$Ouvert, PDO::PARAM_BOOL);

        try{
            $stmt->execute();
        }
        catch (PDOException $e){
            echo 'Erreur ', PHP_EOL;
            echo 'Requete : ',$sql,PHP_EOL;
            exit;
        }

    }