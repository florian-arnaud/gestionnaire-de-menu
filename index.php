<?php
session_start();
if (!isset($_SESSION['nom_utilisateur'])) {
    header('Location: login.php');
    exit;
}
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
    <p>Bienvenue, <?php echo $_SESSION["nom_utilisateur"]?></p>
        
</body>
</html>