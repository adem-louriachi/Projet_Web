    <?php
    require 'LinkBD.php';
    
    $pdo=ConnectBD();

    $sql = 'INSERT INTO Message VALUES IdDiscussion, TextMessage, EstOuvert
             WHERE ';
    $stmt = $pdo->prepare($sql);
