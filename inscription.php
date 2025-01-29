<!-- Récupère le fichier de connexion à la base de données -->

<?php session_start();
require "config/connexionBDD.php";
if (isset($_SESSION["nom_utilisateur"])) {
    header('Location: index.php');
}

if ($_POST) {
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hash le mot de passe pour le stocker dans la base de données

    // Prépare la requête pour sélectionner les données de l'utilisateur, permettant de vérifier si le nom d'utilisateur est déjà utilisé ou non.
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $requete->execute(['nom_utilisateur' => $nom_utilisateur]);
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);

    if ($reponse) {
        echo "Nom d'utilisateur déjà utilisé";
    } else {
        $requete = $connexion->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)");
        $requete->execute([
            'nom_utilisateur' => $nom_utilisateur,
            'mot_de_passe' => $mot_de_passe
        ]);
        header('Location: login.php');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
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

<body>
    <form action="inscription.php" method="post">
        <div> <label for="nom_utilisateur">Nom d'utilisateur:</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        </div>

        <div> <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>

        <input type="submit" value="S'inscrire">
    </form>
</body>

</html>