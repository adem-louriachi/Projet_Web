 <!doctype html>

<html lang="fr">

    <head>
    <!-- Balise Meta -->
        <meta charset="UTF-8"/>
        <meta name="author" content="Paul Chabas, Vincent Ferrer, Adem Louriachi, Guillaume Piccina" />
        <meta name="description" content="Site FreeNote Projet Web - 3eme semestre - DUT Informatique, professeur : Olivier Gérard"/>
    <!-- Stylesheet -->
        <link rel="stylesheet" href="Vues/AccueilVue.css"/>

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

            <img src="https://imagizer.imageshack.com/img923/196/79WmYc.png">

        </header>

        <main>

            <div class="formulaire">
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
            </div>
            <section>
                <h1>Description du site</h1>
                <p>Bienvenue sur FreeNote ! <br> Un réseau social où les messages privés n'existent pas. <br>
                   Vous pouvez lancer une discussion sur un sujet (La mort de Jacques Chirac, Pourquoi il ne faut pas boire de Munster, L'utilité d'un BDE, Greta Thunberg, etc.).
                   Puis, vous, cher.ère.s membres, pouvez participer à chaque discussion. <br>
                   Cependant, nous ne sommes pas ici pour créer un basique forum. Chacun de vous ne peut écrire que deux mots dans un message sur toute une discussion ET C'EST TOUT. <br>
                   Choisissez avec soin...</p>
            </section>
        </main>

        <footer>


        </footer>


    </body>


</html>