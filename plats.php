<?php session_start();
require "config/connexionBDD.php";


$requete = $connexion->prepare("SELECT * FROM categories");
$requete->execute();
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
$requete = $connexion->prepare("SELECT id_plat, nom_plat, nom_categorie, prix_plat, ingredient_1, ingredient_2, ingredient_3, image_plat FROM plats, categories WHERE plats.id_categorie = categories.id_categorie;");
$requete->execute();
$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
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
        <h1>Liste des plats</h1>
        <table>
            <thead>
                <th>Nom du plat</th>
                <th>Type de plat</th>
                <th>Prix en €</th>
                <th>Ingrédient 1</th>
                <th>Ingrédient 2</th>
                <th>Ingrédient 3</th>
                <th>Image</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>

            <tbody>
                <!-- Boucle sur le tableau de la requête SELECT pour afficher chaque ligne de plat -->
                <?php foreach ($resultat as $plat) {
                    echo "<tr>";
                    echo "<td>" . $plat['nom_plat'] . "</td>";
                    echo "<td>" . $plat['nom_categorie'] . "</td>";
                    echo "<td>" . $plat['prix_plat'] . "</td>";
                    echo "<td>" . $plat['ingredient_1'] . "</td>";
                    echo "<td>" . $plat['ingredient_2'] . "</td>";
                    echo "<td>" . $plat['ingredient_3'] . "</td>";
                    echo "<td><img src='images/images_plats/" . $plat['image_plat'] . "' alt='Image du plat'></td>";
                    echo "<td><a href='modifier_plat.php?id=" . $plat['id_plat'] . "'>Modifier</a></td>";
                    echo "<td><a href='supprimer_plat.php?id=" . $plat['id_plat'] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>

</html>