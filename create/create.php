<?php

$connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus', 'root', '' );
if(!$connexion){
        die("Erreur : La connexion a échoué.");
}
 session_start();

 
 ?>
 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="css/normalize.css">
     <link rel="stylesheet" href="css/style.css">
     <title>Créer votre menu</title>
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
     <form action="create.php" method="post">
         <label for="create.php">Créer votre menu</label>
         <input type="text" id="menu" name="menu" required>
        </form>
    
    <img src="Spaghettis" alt = "Plat de spaghettis">
    <img src="Plat" alt = "Plat ">
    <img src="Riz" alt = "Riz">
    
 </body>
 </html>