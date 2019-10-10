<!doctype html>

<html lang="fr">

    <head>
    <!-- Balise Meta -->
        <meta charset="UTF-8"/>
        <meta name="author" content="Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina" />
        <meta name="description" content="Site FreeNote Projet Web - 3eme semestre - DUT Informatique, professeur : Olivier Gérard"/>
    <!-- Stylesheet -->
        <link rel="stylesheet" href="Vues/AccueilVue.css"/>

        <title>FreeNote by 4randoms</title>

    </head>

    <body>

        <header> <!-- en-tête -->

            <img src="https://imagizer.imageshack.com/img923/196/79WmYc.png">

        </header>

        <main>
            <form id="inscription" method="post" action="Controlleurs/inscription.php">
                <label name="nom">Nom</label>
                <input name="nom" type="text" placeholder="Jean">
                <label name="email">Adresse e-mail</label>
                <input name="email" type="email" placeholder="jean@jean.fr">
                <label name="mdp">Mot de passe</label>
                <input name="mdp" type="password">
                <label name="mdpconf">Confirmation du mot de passe</label>
                <input name="mdpconf" type="password">
                <input type="submit" value="Inscription">
            </form>
            <form id="connexion" method="post" action="Controlleurs/connexion.php">
                <label name="email">Adresse e-mail</label>
                <input name="email" type="email">
                <label name="mdp">Mot de passe</label>
                <input name="mdp" type="password">
                <input type="submit" value="Connexion">
            </form>
            <a>Déjà inscrit ?</a> <!-- Javascript à écrire pour passer la visibilité d'inscription à connexion -->
        </main>

        <footer>


        </footer>


    </body>


</html>