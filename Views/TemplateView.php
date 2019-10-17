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
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>FreeNote by 4randoms</title>

</head>

<body>

<header> <!-- en-tête -->
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper black">
                <a href="../index.php"><img class="brand-logo nav-wrapper" alt="Logo de FreeNote" src="https://image.noelshack.com/fichiers/2019/41/4/1570720588-free-2.png"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
<<<<<<< HEAD
                    <?php include '/Controllers/AuthenticationCheck.php';?>
=======
            <?php include 'Controllers/AuthenticationCheck.php';?>
>>>>>>> parent of 84ec48e... Mise en /
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <?php include '/Controllers/AuthenticationCheck.php';?>
    </ul>

</header>

<main>

<?= $content ?>

</main>

<footer>

    <blockquote>Site réalisé par Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina</blockquote>

</footer>

</body>

</html>
