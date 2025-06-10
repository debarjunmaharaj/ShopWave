<?php
require_once 'config.php';

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$cart_total = 0;
if (!empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $stmt = $pdo->prepare("SELECT id, price FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);
    $products = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $cart_total += $products[$product_id] * $quantity;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    try {
        $pdo->beginTransaction();

        // 1. Insert into orders table
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_address, customer_phone, total_amount, status) VALUES (?, ?, ?, ?, 'Pending')");
        $stmt->execute([$name, $address, $phone, $cart_total]);
        $order_id = $pdo->lastInsertId();

        // 2. Insert into order_items table
        $stmt_items = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_per_item) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
             // Fetch current price again to be safe
            $price = $products[$product_id];
            $stmt_items->execute([$order_id, $product_id, $quantity, $price]);
        }

        $pdo->commit();

        // 3. Clear the cart and redirect to thank you page
        unset($_SESSION['cart']);
        header('Location: thank_you.php');
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        $error_message = "Order failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Modern E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="container">
        <h1 class="page-title">Checkout</h1>
        <?php if (isset($error_message)) echo "<p class='error'>{$error_message}</p>"; ?>
        <div class="checkout-layout">
            <div class="checkout-form">
                <form action="checkout.php" method="post">
                    <h3>Delivery Information</h3>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Full Address (Street, City, Zip)</label>
                        <textarea id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>

                    <h3>Payment Method</h3>
                    <div class="form-group">
                        <label class="radio-label">
                            <input type="radio" name="payment_method" value="cod" checked required>
                            Cash on Delivery (COD)
                        </label>
                    </div>
                    
                    <button type="submit" class="btn">Place Order</button>
                </form>
            </div>
            <div class="order-summary">
                <h3>Order Summary</h3>
                <p>Total Amount: <strong>$<?php echo number_format($cart_total, 2); ?></strong></p>
                <p>Pay with cash upon delivery.</p>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html>