<?php
session_start();
// Dummy data pour le styling
$categories = [
    ['id' => 1, 'nom' => 'Entrées'],
    ['id' => 2, 'nom' => 'Plats principaux'],
    ['id' => 3, 'nom' => 'Desserts']
];

$plats = [
    [
        'id' => 1,
        'nom' => 'Salade César',
        'description' => 'Laitue romaine, croûtons, parmesan',
        'prix' => 9.90,
        'categorie_id' => 1,
        'image' => 'images/salade.jpg'
    ],
    [
        'id' => 2,
        'nom' => 'Steak Frites',
        'description' => 'Bavette de boeuf, frites maison',
        'prix' => 16.50,
        'categorie_id' => 2,
        'image' => 'images/steak.jpg'
    ]
];

$menus = [
    [
        'id' => 1,
        'nom' => 'Menu du Jour',
        'description' => 'Entrée + Plat + Dessert',
        'prix' => 24.90,
        'plats' => [1, 2]
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            color: white;
            padding: 20px;
        }
        
        .nav-link {
            color: #ecf0f1 !important;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background: #34495e;
            transform: translateX(5px);
        }
        
        .dish-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .dish-card:hover {
            transform: translateY(-5px);
        }
        
        .menu-price {
            font-size: 1.5rem;
            color: #27ae60;
            font-weight: bold;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="position-sticky pt-3">
                    <h2 class="mb-4">Mon Restaurant</h2>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link active" href="#plats">
                                <i class="fas fa-utensils me-2"></i>Plats
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#menus">
                                <i class="fas fa-clipboard-list me-2"></i>Menus
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#categories">
                                <i class="fas fa-tags me-2"></i>Catégories
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 p-4">
                <!-- Plats Section -->
                <section id="plats">
                    <h2 class="mb-4">Gestion des Plats</h2>
                    
                    <!-- Add Dish Form -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Nom du plat">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select">
                                        <option>Choisir une catégorie</option>
                                        <?php foreach ($categories as $cat): ?>
                                        <option><?= htmlspecialchars($cat['nom']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" placeholder="Prix">
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control">
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary px-4">
                                        <i class="fas fa-plus me-2"></i>Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Dishes Grid -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php foreach ($plats as $plat): ?>
                        <div class="col">
                            <div class="card dish-card h-100 shadow">
                                <img src="<?= $plat['image'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($plat['nom']) ?></h5>
                                    <p class="card-text text-muted"><?= htmlspecialchars($plat['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary"><?= $categories[$plat['categorie_id']-1]['nom'] ?></span>
                                        <span class="menu-price"><?= number_format($plat['prix'], 2) ?>€</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <button class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Menus Section -->
                <section id="menus" class="mt-5" style="display: none;">
                    <h2 class="mb-4">Gestion des Menus</h2>
                    
                    <!-- Add Menu Form -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <!-- Form similaire au formulaire des plats -->
                        </div>
                    </div>

                    <!-- Menus List -->
                    <div class="row">
                        <?php foreach ($menus as $menu): ?>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($menu['nom']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($menu['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-success fw-bold"><?= number_format($menu['prix'], 2) ?>€</span>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>