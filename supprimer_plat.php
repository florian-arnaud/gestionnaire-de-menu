<?php
session_start();
require_once "config/connexionBDD.php";
$id_plat = trim(htmlspecialchars($_GET['id']));
$requete = $connexion->prepare("DELETE FROM plats WHERE id_plat = :id_plat");
$requete->execute(['id_plat' => $id_plat]); 
if ($requete) {
    header('Location: plats.php');
} else {
    echo "Erreur lors de la suppression du plat";
}
?>