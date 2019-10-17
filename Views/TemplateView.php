<!doctype html>

<html lang="fr">

<head>
    <!-- Balise Meta -->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina" />
    <meta name="description" content="Site FreeNote Projet Web - 3eme semestre - DUT Informatique, professeur : Olivier Gérard"/>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=$style?>"/>
    <title>FreeNote by 4randoms</title>

</head>

<body>

<header> <!-- en-tête -->

    <img id="logo" alt="Logo de FreeNote" src="https://image.noelshack.com/fichiers/2019/41/4/1570720588-free-2.png">
    <?php include 'Controllers/AuthenticationCheck.php';?>
</header>

<main>

<?= $content ?>

</main>

<footer>

    <blockquote>Site réalisé par Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina</blockquote>

</footer>

</body>

</html>
