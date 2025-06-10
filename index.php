<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModernShop - Homepage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Slider Section -->
        <?php 
        $slides = $pdo->query("SELECT * FROM slider_images ORDER BY sort_order ASC, id DESC")->fetchAll();
        ?>
        <section class="hero-slider <?php echo empty($slides) ? 'no-slides' : ''; ?>">
            <div class="slider-container">
                <?php if (!empty($slides)): ?>
                    <?php foreach ($slides as $index => $slide): ?>
                        <div class="slide<?php echo ($index === 0 ? ' active' : ''); ?>" style="background-image: url('uploads/slider/<?php echo htmlspecialchars($slide['image_file']); ?>');"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="hero-content-overlay fade-in">
                     <h1><?php echo htmlspecialchars($settings['hero_title']); ?></h1>
                     <p><?php echo htmlspecialchars($settings['hero_subtitle']); ?></p>
                     <a href="products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <?php if (count($slides) > 1): ?>
                <button class="slider-btn prev">❮</button>
                <button class="slider-btn next">❯</button>
            <?php endif; ?>
        </section>


        <!-- Featured Products Section -->
        <section class="section-padding">
            <div class="container">
                <h2 class="section-title">Featured Products</h2>
                <div class="product-grid">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
                    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='product-card' data-tilt>";
                        echo "<a href='product_detail.php?id={$product['id']}'>";
                        echo "<div class='product-image' style='background-image: url(uploads/" . htmlspecialchars($product['image']) . ")'></div>";
                        echo "<div class='product-info'>";
                        echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
                        echo "<p class='price'>" . htmlspecialchars($settings['currency_symbol']) . htmlspecialchars($product['price']) . "</p>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <section class="section-padding bg-light">
            <div class="container text-center">
                <h2 class="section-title">Easy & Secure Payments</h2>
                <p class="lead">We offer <strong>Cash on Delivery (COD)</strong> for all orders. Pay only when you receive your items. It's simple, secure, and hassle-free.</p>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>