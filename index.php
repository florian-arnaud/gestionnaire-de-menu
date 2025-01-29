<?php
session_start();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestionnaire de menus - Accueil</title>
</head>
<body>
    <header>
        <h1>Gestionnaire de menus</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php if(!isset($_SESSION))
                {
                    echo "<li><a href='login.php'>Connexion</a></li>";
                }
                else
                {
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                }
                ?>
            </ul>
        </nav>
        <?php 
        if(isset($_SESSION["nom_utilisateur"])){
            echo "<p>Bienvenue, ".$_SESSION["nom_utilisateur"]."</p>";
        }
        ?>
        
</body>
</html>