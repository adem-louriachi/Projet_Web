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

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>FreeNote by 4randoms</title>

</head>

<body>

<header> <!-- en-tête -->

    <img id="logo" alt="Logo de FreeNote" src="https://image.noelshack.com/fichiers/2019/41/4/1570720588-free-2.png">

</header>

<main>

<?= $content ?>

</main>

<footer>

    <blockquote>Site réalisé par Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina</blockquote>

</footer>

</body>

</html>
