<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestionnaire de menus - Accueil</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <div>
                    <li><a href="index.php">Accueil</a></li>

                </div>
                <?php if (!isset($_SESSION['nom_utilisateur'])) {
                    echo "<li><a href='login.php'>Connexion</a></li>";
                    echo "<li><a href='inscription.php'>S'inscrire</a></li>";
                } else {
                    echo "<div>";
                    echo "<li><a href='#'>" . $_SESSION['nom_utilisateur'] . "</a></li>";
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    echo "</div>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Gestionnaire de menus</h1>

        <?php
        if (isset($_SESSION["nom_utilisateur"])) {
            echo "<p>Bienvenue, " . $_SESSION["nom_utilisateur"] . "</p>";
        }
        ?>

        <section>

            <article id="article_ajout_plat">
                <a href="ajouter_plat.php">        <h2>Ajouter un plat</h2>

                </a>
            </article>

            <article id="article_affichage_plats">
                <a href="plats.php">
                    <h2>Afficher, modifier ou supprimer un plat</h2>
                </a>

            </article>
        </section>



    </main>


</body>

</html>