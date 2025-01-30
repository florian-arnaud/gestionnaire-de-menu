<?php
session_start();
require "login.php";
if($_SESSION)
{
    header('Location: delete.php');
}
$requete = $delete->prepare("SELECT * FROM");
$requete->execute();
$test = $requete->fetch(PDO::FETCH_ASSOC);

var_dump($_SESSION);
if($_POST)
{
    if(($_POST)[''] === $test[''] && $_POST[''] === $test[''])
    {
        $_SESSION['n'] = $_POST['nom'];
        $_SESSION[''] = $test[''];

    }
    else{
        echo '';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Supprimer</title>
</head>
<body>
    <form action="delete.php" method="post">
        <label for="Ajouter un menu">Supprimer un menu</label>
        <input type="text" id="" name="" required>
        <br>
        <label for=""></label>
        <input type="" id="" name="" required>
        <br>
        <input type="" value="">
    </form>
</body>
</html>