<?php session_start();
require "../config/connexionBDD.php";
$id_menu = trim(htmlspecialchars($_GET['id']));
$requete = $connexion->prepare("SELECT * FROM plats");
$requete->execute();
$plats = $requete->fetchAll(PDO::FETCH_ASSOC);
$requete = $connexion->prepare("SELECT * FROM menus WHERE id_menu = :id_menu");
$requete->execute(['id_menu' => $id_menu]);
$resultat = $requete->fetch(PDO::FETCH_ASSOC);
if($_SESSION['droits'] != 2)
{
    header('Location: index.php');
    exit();
}
if ($_POST) {
    // Vérification des données du formulaire
    $nom_menu = trim(htmlspecialchars($_POST['nom_menu']));
    $plat_1 = isset($_POST['plat_1']) ? trim(htmlspecialchars($_POST['plat_1'])) : null;
    $plat_2 = isset($_POST['plat_2']) ? trim(htmlspecialchars($_POST['plat_2'])) : null;
    $plat_3 = isset($_POST['plat_3']) ? trim(htmlspecialchars($_POST['plat_3'])) : null;
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $description_menu = isset($_POST['description_menu']) ? trim(htmlspecialchars($_POST['description_menu'])) : null;
    $prix_menu = isset($_POST['prix_menu']) ? trim(htmlspecialchars($_POST['prix_menu'])) : null;

     // Insère les données dans la base de données
    $requete = $connexion->prepare("UPDATE menus SET nom_menu = :nom_menu, id_plat_1 = :plat_1, id_plat_2 = :plat_2, id_plat_3 = :plat_3, id_utilisateur = :id_utilisateur, description_menu = :description_menu, prix_menu = :prix_menu WHERE id_menu = :id_menu");
    $requete->execute([
        'nom_menu' => $nom_menu,
        'plat_1' => $plat_1,
        'plat_2' => $plat_2,
        'plat_3' => $plat_3,
        'id_utilisateur' => $id_utilisateur,
        'description_menu' => $description_menu,
        'prix_menu' => $prix_menu,
        'id_menu' => $id_menu
    ]);
    header('Location: menus.php');

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/gestionnaire-de-menu/index/">
    <title>Document</title>
</head>

<body>
<header>
        <nav>
            <ul>
                <div>
                    <li><a href="">Accueil</a></li>

                </div>
                <?php if (!isset($_SESSION['nom_utilisateur'])) {
                    echo "<li><a href='http://localhost/gestionnaire-de-menu/login/login.php'>Connexion</a></li>";
                    echo "<li><a href='http://localhost/gestionnaire-de-menu/inscription/inscription.php'>S'inscrire</a></li>";
                } else {
                    echo "<div>";
                    echo "<li><a href='#'>" . $_SESSION['nom_utilisateur'] . "</a></li>";
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    echo "</div>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="nom_menu">Nom du menu</label>
            <input type="text" name="nom_menu" id="nom_menu" value="<?php echo $resultat['nom_menu']; ?>">
        </div>
        <div>
            <label for="plat_1">Plat n°1</label>
            <select name="plat_1" id="plat_1" >
                <?php foreach ($plats as $plat) {
                    if($plat['id_plat'] == $resultat['id_plat_1'])
                    {
                        echo "<option value='" . $plat['id_plat'] . "' selected>" . $plat['nom_plat'] . "</option>";
                    }
                    else
                    echo "<option value='" . $plat['id_plat'] . "'>" . $plat['nom_plat'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="plat_2">Plat n°2</label>
            <select name="plat_2" id="plat_2">
                <?php foreach ($plats as $plat) {
                    if($plat['id_plat'] == $resultat['id_plat_2'])
                    {
                        echo "<option value='" . $plat['id_plat'] . "' selected>" . $plat['nom_plat'] . "</option>";
                    }
                    else
                    echo "<option value='" . $plat['id_plat'] . "'>" . $plat['nom_plat'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="plat_3">Plat n°3</label>
            <select name="plat_3" id="plat_3">
                <?php foreach ($plats as $plat) {
                    if($plat['id_plat'] == $resultat['id_plat_3'])
                    {
                        echo "<option value='" . $plat['id_plat'] . "' selected>" . $plat['nom_plat'] . "</option>";
                    }
                    else
                    echo "<option value='" . $plat['id_plat'] . "'>" . $plat['nom_plat'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="description_menu">Description</label>
            <input type="text" name="description_menu" id="description_menu" value="<?php echo $resultat['description_menu']; ?>">
        </div>

        <div>
            <label for="prix_menu">Prix en € 1</label>
            <input type="text" name="prix_menu" id="prix_menu" value="<?php echo $resultat['prix_menu']; ?>">
        </div>

        

        <input type="submit" value="Ajouter le menu">

    </form>
            </main>
</body>

</html>