<?php session_start();
 $connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus', 'root', '' );
 if(!$connexion){
         die("Erreur : La connexion a échoué.");
 };
$requete = $connexion->prepare("SELECT * FROM categories");
$requete->execute();
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);
if($_SESSION['droits'] != 2)
{
    
    exit();
}
if ($_POST) {
    // Vérification des données du formulaire
    $nom_plat = trim(htmlspecialchars($_POST['nom_plat']));
    $categorie = trim(htmlspecialchars($_POST['categorie']));
    $ingredient1 = isset($_POST['ingredient1']) ? trim(htmlspecialchars($_POST['ingredient1'])) : null;
    $ingredient2 = isset($_POST['ingredient2']) ? trim(htmlspecialchars($_POST['ingredient2'])) : null;
    $ingredient3 = isset($_POST['ingredient3']) ? trim(htmlspecialchars($_POST['ingredient3'])) : null;
    $prix = isset($_POST['prix']) ? trim(htmlspecialchars($_POST['prix'])) : null;

    // Gestion de l'envoi d'image
    if($_FILES['image_plat']['error'] == 4)
    {
        $fichier = "placeholder.jpg";
    }	
    else if (isset($_FILES['image_plat']) && $_FILES['image_plat']['error'] == 0) {
        $dossier = 'uploads/';
        $fichier = strtolower($nom_plat) . '.' . strtolower(pathinfo($_FILES['image_plat']['name'], PATHINFO_EXTENSION));
        $type_fichier_image = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES['image_plat']['tmp_name'], 'images/images_plats/' . $fichier);
    }
     // Insère les données dans la base de données
     $requete = $connexion->prepare("INSERT INTO plats (nom_plat, id_categorie, ingredient_1, ingredient_2, ingredient_3, image_plat, prix_plat) VALUES (:nom_plat, :id_categorie, :ingredient_1, :ingredient_2, :ingredient_3, :fichier, :prix)");
     $requete->execute([
         'nom_plat' => $nom_plat,
         'id_categorie' => $categorie,
         'ingredient_1' => $ingredient1,
         'ingredient_2' => $ingredient2,
         'ingredient_3' => $ingredient3,
         'fichier' => $fichier,
         'prix' => $prix
     ]);
    unset($_POST);
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

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
            <input type="text" name="nom_plat" id="nom_plat">
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
            <input type="text" name="prix" id="categorie">
        </div>

        <div>
            <label for="Ingrédient 1">Ingrédient 1</label>
            <input type="text" name="ingredient1" id="ingredient1">
        </div>

        <div>
            <label for="Ingrédient 1">Ingrédient 2</label>
            <input type="text" name="ingredient2" id="ingredient2">
        </div>

        <div>
            <label for="Ingrédient 3">Ingrédient 3</label>
            <input type="text" name="ingredient3" id="ingredient3">
        </div>
        <div>
            <label for="image_plat">Image</label>
            <input type="file" name="image_plat" id="image_plat">
        </div>

        <input type="submit" value="Ajouter le plat">

    </form>
            </main>
</body>

</html>