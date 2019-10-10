<?php
try{
    // Connexion à la base de donnee
    $dsn = 'mysql:host localhost;dbname my_dbname';
    $pdo = new PDO($dsn , 'mysql_username', 'mysql_password');
    // Codage de caractères
    $pdo->exec ('SET CHARACTER SET utf8');
    // Gestion des erreurs sous forme d'exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    // Affichage de l'erreur
    die ('Erreur ');
}

