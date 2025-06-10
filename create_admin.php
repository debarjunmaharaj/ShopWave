<?php
// Use this file ONCE to create your admin user, then DELETE it.
require 'config.php';

// --- Configuration ---
$admin_username = 'admin';
// IMPORTANT: Change this password!
$admin_password = 'your_secure_password'; 
// --- End Configuration ---

// Hash the password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Check if user already exists
$stmt = $pdo->prepare("SELECT id FROM admin WHERE username = ?");
$stmt->execute([$admin_username]);
if ($stmt->fetch()) {
    die("Admin user '{$admin_username}' already exists. Please delete this file.");
}

// Insert the new admin user
try {
    $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$admin_username, $hashed_password]);
    echo "Admin user '{$admin_username}' created successfully!<br>";
    echo "<strong>IMPORTANT: DELETE THIS FILE (create_admin.php) NOW!</strong>";
} catch (PDOException $e) {
    die("Error creating admin user: " . $e->getMessage());
}
?>