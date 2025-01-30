<?php 

$connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus', 'root', '' );
if(!$connexion){
        die("Erreur : La connexion a échoué.");
}
session_start();
require "config/connexionBDD.php";
if($_SESSION)
{
    header('Location: index.php');
}
$requete = $connexion->prepare("SELECT * FROM utilisateurs");
$requete->execute();
$test = $requete->fetch(PDO::FETCH_ASSOC);
var_dump($_POST);
var_dump($_SESSION);
if($_POST)
{
    if(($_POST)['mot_de_passe'] === $test['mot_de_passe'] && $_POST['nom_utilisateur'] === $test['nom_utilisateur'])
    {
        $_SESSION['nom_utilisateur'] = $_POST['nom_utilisateur'];
        $_SESSION['droits'] = $test['droits_utilisateur'];
    }
    else{
        echo 'Invalid username or password';
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
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
    <form action="login.php" method="post">
        <label for="nom_utilisateur">Nom d'utilisateur:</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        <br>
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <input type="submit" value="Connexion">
    </form>
</body>
</html>