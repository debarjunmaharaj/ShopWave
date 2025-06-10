<?php
// Start the session on every page
session_start();

// --- Database Credentials ---
define('DB_HOST', 'localhost');
define('DB_USER', 'futurev1_demo'); // Your DB username
define('DB_PASS', 'futurev1_demo'); // Your DB password
define('DB_NAME', 'futurev1_demo'); // Your DB name

// --- Establish Database Connection using PDO ---
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect to the database. " . $e->getMessage());
}

// --- Load Site-wide Settings ---
if (!isset($_SESSION['settings'])) {
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
        $_SESSION['settings'] = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    } catch (PDOException $e) {
        // Fallback default settings if table doesn't exist
        $_SESSION['settings'] = [
            'currency_symbol' => '$',
            'hero_title'      => 'Default Title',
            'hero_subtitle'   => 'Default Subtitle',
            'footer_text'     => '© ' . date('Y') . ' Modern E-commerce.'
        ];
    }
}
$settings = $_SESSION['settings'];

// --- Helper Functions ---
function getCartCount() {
    return isset($_SESSION['cart']) ? array_sum(array_values($_SESSION['cart'])) : 0;
}
?>