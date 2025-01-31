<?php
session_start();
require_once "config/connexionBDD.php";

if($_SESSION['droits'] != 2)
{
    header('Location: index.php');
    exit();
}

$id_menu = trim(htmlspecialchars($_GET['id']));
$requete = $connexion->prepare("DELETE FROM menus WHERE id_menu = :id_menu");
$requete->execute(['id_menu' => $id_menu]); 
if ($requete) {
    header('Location: menus.php');
} else {
    echo "La suppression n'a pas fonctionné.";
}
?>