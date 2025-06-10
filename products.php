<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Modern E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="container">
        <h1 class="page-title">All Products</h1>
        
        <div class="product-grid">
            <?php
            $stmt = $pdo->query("SELECT * FROM products ORDER BY name ASC");
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='product-card fade-in'>";
                echo "<a href='product_detail.php?id={$product['id']}'>";
                echo "<img src='uploads/{$product['image']}' alt='{$product['name']}'>";
                echo "<h3>{$product['name']}</h3>";
                echo "<p class='price'>$" . htmlspecialchars($product['price']) . "</p>";
                echo "</a>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html>