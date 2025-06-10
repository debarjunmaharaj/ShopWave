<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You! - Modern E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="container text-center">
        <div class="thank-you-message">
            <h1>Thank You For Your Order!</h1>
            <p>Your order has been placed successfully. We will contact you shortly for confirmation.</p>
            <p>Your payment method is <strong>Cash on Delivery</strong>.</p>
            <a href="products.php" class="btn">Continue Shopping</a>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>