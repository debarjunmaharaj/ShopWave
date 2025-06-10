<?php
require_once 'config.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        if ($product_id && $quantity > 0) {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
        header('Location: cart.php');
        break;

    case 'update':
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        if ($product_id && $quantity > 0) {
            $_SESSION['cart'][$product_id] = $quantity;
        } else {
            // If quantity is 0 or less, remove it
            unset($_SESSION['cart'][$product_id]);
        }
        header('Location: cart.php');
        break;

    case 'remove':
        $product_id = $_GET['id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
        header('Location: cart.php');
        break;

    default:
        header('Location: index.php');
}
exit;
?>