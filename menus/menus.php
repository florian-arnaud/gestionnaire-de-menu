<?php session_start();
require ("../config/connexionBDD.php");


$requete = $connexion->prepare("SELECT * FROM plats");
$requete->execute();
$plats = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = $connexion->prepare("SELECT menus.id_menu, menus.nom_menu, plats1.id_plat AS id_plat1, plats1.nom_plat AS nom_plat1, plats2.id_plat AS id_plat2, plats2.nom_plat AS nom_plat2, plats3.id_plat AS id_plat3, plats3.nom_plat AS nom_plat3, menus.prix_menu, menus.description_menu, utilisateurs.nom_utilisateur FROM menus LEFT JOIN plats AS plats1 ON menus.id_plat_1 = plats1.id_plat LEFT JOIN plats AS plats2 ON menus.id_plat_2 = plats2.id_plat LEFT JOIN plats AS plats3 ON menus.id_plat_3 = plats3.id_plat LEFT JOIN utilisateurs ON menus.id_utilisateur = utilisateurs.id_utilisateur; ");
$requete->execute();
$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <div>
                    <li><a href="http://localhost/gestionnaire-de-menu/index/">Accueil</a></li>
                     <li> <a href=".http://localhost/gestionnaire-de-menu/login/login.php">Connexion</a></li>
                    <li><a href="http://localhost/gestionnaire-de-menu/inscription/inscription.php">S'inscrire<s/a> </li >                              
                    
                    
                </div>
                <?php if (!isset($_SESSION['nom_utilisateur'])) {
                    echo "<li><a href='http://localhost/gestionnaire-de-menu/login/login.php'>Connexion</a></li>";
                    echo "<li><a href='http://localhost/gestionnaire-de-menu/inscription/inscription.php>S'inscrire</a></li>";
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
        <table>
            <thead>
                <th>Nom du menu</th>
                <th>Plat n°1</th>
                <th>Plat n°2</th>
                <th>Plat n°3</th>
                <th>Prix en €</th>
                <th>Description</th>
                <th>Restaurateur</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </thead>

            <tbody>
                <!-- Boucle sur le tableau de la requête SELECT pour afficher chaque ligne de plat -->
                 
                <?php
                foreach ($resultat as $menu) {
                    echo "<tr>";
                    echo "<td>" . $menu['nom_menu'] . "</td>";
                    echo "<td>" . $menu['nom_plat1'] . "</td>";
                    echo "<td>" . $menu['nom_plat2'] . "</td>";
                    echo "<td>" . $menu['nom_plat3'] . "</td>";
                    echo "<td>" . $menu['prix_menu'] . "</td>";
                    echo "<td>" . $menu['description_menu'] . "</td>";
                    echo "<td>" . $menu['nom_utilisateur'] . "</td>";
                    echo "<td><a href='modifier_menu.php?id=" . $menu['id_menu'] . "'>Modifier</a></td>";
                    echo "<td><a href='supprimer_menu.php?id=" . $menu['id_menu'] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>

</html>