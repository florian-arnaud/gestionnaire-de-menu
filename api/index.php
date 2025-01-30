<?php

$connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus', 'root', '' );
if(!$connexion){
        die("Erreur : La connexion a échoué.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestionnaire de menus - Accueil</title>
</head>
<header>
    <nav>
        <a href = "index.php">Accueil</a>
        <a href = "login.php"> Connexion</a>
        <a href = "delete.php"> Supprimer</a>
        <a href = "update.php"> Modifier</a>
    </nav>
 </header> 
<body>
    <p>Bienvenue, </p>
    <img src="Spaghettis" alt = "Plat de spaghettis">
    <img src="Plat" alt = "Plat ">
    <img src="Riz" alt = "Riz">
    
    
</body>
</html>