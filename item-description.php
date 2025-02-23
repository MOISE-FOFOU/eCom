<?php
session_start();
include "db_conn.php";

// Vérifier l'authentification de l'utilisateur
$email = $_SESSION['email'] ?? $_SESSION['admin_email'] ?? null;

// Récupérer l'ID du produit depuis l'URL
$productId = $_GET['itemid'] ?? null;

if (!$productId) {
    die("Produit introuvable.");
}

// Récupérer les détails du produit
$sqlQuery = "SELECT * FROM products WHERE item_id = ?";
$stmt = $conn->prepare($sqlQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Produit introuvable.");
}

// Produits de la même catégorie
$sqlQuery2 = "SELECT * FROM products WHERE category = ? AND item_id != ? LIMIT 4";
$stmt2 = $conn->prepare($sqlQuery2);
$stmt2->bind_param("si", $product['category'], $productId);
$stmt2->execute();
$result2 = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['item_name']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .breadcrumb {
            background: none;
            font-size: 14px;
        }
        .main-img {
            border-radius: 10px;
            border: 1px solid #ddd;
            width: 100%;
            max-height: 450px;
            object-fit: cover;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s ease-in-out;
            margin-right: 5px;
        }
        .thumbnail:hover {
            transform: scale(1.1);
        }
        .card {
            border: none;
            transition: transform 0.2s ease-in-out;
        }
        .card img {
            border-radius: 10px 10px 0 0;
            height: 200px;
            object-fit: cover;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-size: 16px;
            font-weight: bold;
        }
        .btn-success {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php $page = 'product'; include 'header.php'; ?>

    <div class="container mt-4">
        <!-- Fil d'Ariane -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                <li class="breadcrumb-item"><a href="shopping_page.php"><?php echo htmlspecialchars($product['category']); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['item_name']); ?></li>
            </ol>
        </nav>

        <!-- Détails du produit -->
        <div class="row">
            <div class="col-md-6">
                <img id="ProductImg" class="img-fluid main-img" src="<?php echo $product['img_name1']; ?>" alt="Produit">
                <div class="d-flex mt-2">
                    <?php for ($i = 1; $i <= 4; $i++) {
                        if (!empty($product['img_name' . $i])) {
                            echo "<img src='" . $product['img_name' . $i] . "' class='img-thumbnail thumbnail' onclick=\"document.getElementById('ProductImg').src=this.src\" alt='Thumbnail'>";
                        }
                    } ?>
                </div>
            </div>

            <div class="col-md-6">
                <h2><?php echo htmlspecialchars($product['item_name']); ?></h2>
                <h4 class="text-danger">LKR <?php echo number_format($product['item_price'], 2); ?></h4>
                <p><?php echo nl2br(htmlspecialchars($product['long_description'])); ?></p>

                <form method="post" action="shopping_cart.php" class="mt-3">
                    <input type="hidden" name="id" value="<?php echo $productId; ?>">
                    <label class="fw-bold">Quantité :</label>
                    <input type="number" name="num-product" value="1" min="1" class="form-control w-25 d-inline">
                    <button type="submit" name="submit" class="btn btn-success ms-2">🛒 Ajouter au panier</button>
                </form>
            </div>
        </div>

        <!-- Produits similaires -->
        <h3 class="mt-5">Produits similaires</h3>
        <div class="row">
            <?php while ($row = $result2->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <a href="item-description.php?itemid=<?php echo $row['item_id']; ?>">
                            <img src="<?php echo $row['img_name1']; ?>" class="card-img-top" alt="Produit">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['item_name']); ?></h5>
                                <p class="card-text text-danger">LKR <?php echo number_format($row['item_price'], 2); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
