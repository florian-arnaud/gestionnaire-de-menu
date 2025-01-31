<!-- Récupère le fichier de connexion à la base de données -->
<?php session_start();
require "config/connexionBDD.php";
if (isset($_SESSION["nom_utilisateur"])) {
    header('Location: index.php');
}

if ($_POST) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    //Vérifie si le formulaire a déjà été envoyé (Si $_POST n'est pas vide)

    // Prépare la requête pour sélectionner les données de l'utilisateur, permettant de vérifier si les informations sont correctes ou non.
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $requete->execute(['nom_utilisateur' => $nom_utilisateur]);
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);
    $mot_de_passe = $_POST['mot_de_passe'];

    //Vérifie si le mot de passe correspond au mot de passe hashé dans la base de données. Si les identifiants sont bons, on stocke dans la session. Sinon, on affiche un message d'erreur.
    if ($reponse && password_verify($mot_de_passe, $reponse['mot_de_passe'])) {
        $_SESSION['nom_utilisateur'] = $_POST['nom_utilisateur'];
        $_SESSION['droits'] = $reponse['droits_utilisateur'];
        header('Location: index.php');
    } else {
        echo 'Identifiant ou mot de passe incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>

<nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php if(!isset($_SESSION['nom_utilisateur']))
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

    <form action="login.php" method="post">
        <div> <label for="nom_utilisateur">Nom d'utilisateur:</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        </div>

        <div> <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>

        <input type="submit" value="Connexion">
    </form>
</body>

</html>