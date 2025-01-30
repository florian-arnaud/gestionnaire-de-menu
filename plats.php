<?php session_start();
require "config/connexionBDD.php";
$requete = $connexion->prepare("SELECT * FROM categories");
$requete->execute();
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    var_dump($_POST);
    var_dump($_FILES);
    $nom_plat = trim(htmlspecialchars($_POST['nom_plat']));
    $categorie = trim(htmlspecialchars($_POST['categorie']));
    ($_POST['ingredient1']) ? $ingredient1 = trim(htmlspecialchars($_POST['ingredient1'])) : $ingredient1 = null;
    ($_POST['ingredient2']) ? $ingredient2 = trim(htmlspecialchars($_POST['ingredient2'])) : $ingredient2 = null;
    ($_POST['ingredient3']) ? $ingredient3 = trim(htmlspecialchars($_POST['ingredient3'])) : $ingredient3 = null;

    if (isset($_FILES['image_plat']) && $_FILES['image_plat']['error'] == 0) {
        $dossier = 'uploads/';
        $fichier = strtolower($nom_plat) . '.' . strtolower(pathinfo($_FILES['image_plat']['name'], PATHINFO_EXTENSION));
        $type_fichier_image = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES['image_plat']['tmp_name'], 'images/images_plats/' . $fichier);

        $requete = $connexion->prepare("INSERT INTO plats (nom_plat, id_categorie, ingredient_1, ingredient_2, ingredient_3, image_plat) VALUES (:nom_plat, :id_categorie, :ingredient_1, :ingredient_2, :ingredient_3, :fichier)");
        $requete->execute([
            'nom_plat' => $nom_plat,
            'id_categorie' => $categorie,
            'ingredient_1' => $ingredient1,
            'ingredient_2' => $ingredient2,
            'ingredient_3' => $ingredient3,
            'fichier' => $fichier
        ]);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
</body>

</html>