<?php
session_start();
$connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menu', 'root', '' );
            if(!$connexion){
                    die("Erreur : La connexion a échoué.");
            }
require "config/connexionBDD.php";
if($_SESSION['droits'] != 2)
{
    header('Location: index.php');
    exit();
}
$id_plat = trim(htmlspecialchars($_GET['id']));
$requete = $connexion->prepare("SELECT * FROM categories");
$requete->execute();
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = $connexion->prepare("SELECT * FROM plats WHERE id_plat = :id_plat");
$requete->execute(['id_plat' => $id_plat]);
$resultat = $requete->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    // Gestion de l'envoi d'image
    if ($_FILES['image_plat']['error'] == 4) {
        $fichier = $resultat['image_plat'];
    } else if (isset($_FILES['image_plat']) && $_FILES['image_plat']['error'] == 0) {
        $dossier = 'uploads/';
        $fichier = strtolower($nom_plat) . '.' . strtolower(pathinfo($_FILES['image_plat']['name'], PATHINFO_EXTENSION));
        $type_fichier_image = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES['image_plat']['tmp_name'], 'images/images_plats/' . $fichier);
    }


    $requete = $connexion->prepare("UPDATE plats SET nom_plat = :nom_plat, id_categorie = :id_categorie, prix_plat = :prix, ingredient_1 = :ingredient_1, ingredient_2 = :ingredient_2, ingredient_3 = :ingredient_3, image_plat = :image_plat WHERE id_plat = :id_plat");
    $requete->execute([
        'nom_plat' => trim(htmlspecialchars($_POST['nom_plat'])),
        'id_categorie' => trim(htmlspecialchars($_POST['categorie'])),
        'prix' => trim(htmlspecialchars($_POST['prix'])),
        'ingredient_1' => trim(htmlspecialchars($_POST['ingredient1'])),
        'ingredient_2' => trim(htmlspecialchars($_POST['ingredient2'])),
        'ingredient_3' => trim(htmlspecialchars($_POST['ingredient3'])),
        'image_plat' => trim(htmlspecialchars($fichier)),
        'id_plat' => $id_plat
    ]);
    header('Location: plats.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <title>Modification de plat</title>
</head>

<body>

    <body>

        <header>
            <nav>
                <ul>
                    <div>
                        <li><a href="index.php">Accueil</a></li>

                    </div>
                    <?php if (!isset($_SESSION['nom_utilisateur'])) {
                        echo "<li><a href='login.php'>Connexion</a></li>";
                        echo "<li><a href='inscription.php'>S'inscrire</a></li>";
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
                    <label for="nom_plat">Nom du plat</label>
                    <input type="text" name="nom_plat" id="nom_plat" value="<?php echo $resultat['nom_plat']; ?>">
                </div>
                <div>
                    <label for="categorie">Type de plat</label>
                    <select name="categorie" id="categorie">
                        <?php foreach ($categories as $categorie) {
                            echo "<option value='" . $categorie['id_categorie'] . "'>" . $categorie['nom_categorie'] . "</option>";
                        }
                        ?>
                    </select>

                </div>

                <div>
                    <label for="prix">Prix en €</label>
                    <input type="text" name="prix" id="categorie" value="<?php echo $resultat['prix_plat']; ?>">
                </div>

                <div>
                    <label for="Ingrédient 1">Ingrédient 1</label>
                    <input type="text" name="ingredient1" id="ingredient1" value="<?php echo $resultat['ingredient_1']; ?>">
                </div>

                <div>
                    <label for="Ingrédient 1">Ingrédient 2</label>
                    <input type="text" name="ingredient2" id="ingredient2" value="<?php echo $resultat['ingredient_2']; ?>">
                </div>

                <div>
                    <label for="Ingrédient 3">Ingrédient 3</label>
                    <input type="text" name="ingredient3" id="ingredient3" value="<?php echo $resultat['ingredient_3']; ?>">
                </div>
                <div>
                    <label for="image_plat">Image</label>
                    <input type="file" name="image_plat" id="image_plat">
                </div>

                <input type="submit" value="Modifier le plat">

            </form>
        </main>

    </body>

</html>