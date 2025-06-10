<?php
require_once 'config.php';

$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);
    
    $products_in_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($products_in_db as $product) {
        $product_id = $product['id'];
        $quantity = $_SESSION['cart'][$product_id];
        $cart_items[] = [
            'id' => $product_id,
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity
        ];
        $total_price += $product['price'] * $quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Modern E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main class="container">
        <h1 class="page-title">Your Shopping Cart</h1>
        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty.</p>
            <a href="products.php" class="btn">Continue Shopping</a>
        <?php else: ?>
            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td>
                                <div class="cart-product-info">
                                    <img src="uploads/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form action="cart_actions.php?action=update" method="post" class="update-form">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <a href="cart_actions.php?action=remove&id=<?php echo $item['id']; ?>" class="remove-btn">Remove</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="cart-summary">
                    <h3>Cart Total: $<?php echo number_format($total_price, 2); ?></h3>
                    <a href="checkout.php" class="btn">Proceed to Checkout</a>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html>