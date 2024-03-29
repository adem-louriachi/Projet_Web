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
    <link rel="stylesheet" href="/materialize/css/materialize.css">
    <link rel="stylesheet" href="/materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <title>FreeNote by 4randoms</title>

</head>

<body>

<header> <!-- en-tête -->
        <nav>
            <div class="nav-wrapper black">
                <a href="/">
                    <img class="brand-logo nav-wrapper" alt="Logo de FreeNote" src="https://image.noelshack.com/fichiers/2019/41/4/1570720588-free-2.png">
                </a>
                <a href="#" class="sidenav-trigger" data-target="mobile-links">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down">
                    <?= $auth?>
                </ul>
            </div>
        </nav>
    <ul class="sidenav" id="mobile-links">
        <?= $auth?>
    </ul>

</header>

<main>

<?= $content ?>

</main>

<footer>

    <blockquote>Site réalisé par Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina</blockquote>

</footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        })
    </script>
</body>

</html>
