<?php
// db.php: Establishes a connection to the MySQL database

$host = 'localhost'; // Database host (usually 'localhost')
$db = 'graphite-management'; // Database name
$user = 'root'; // Database user (default for XAMPP is 'root')
$pass = ''; // Database password (default for XAMPP is '')

// Try to establish a connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Output error message if the connection fails
    echo "Connection failed: " . $e->getMessage();
}

// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch maintenance mode status from system_settings table
$stmt = $pdo->prepare('SELECT maintenance_mode FROM system_settings WHERE id = 1');
$stmt->execute();
$systemSettings = $stmt->fetch(PDO::FETCH_ASSOC);

// If maintenance mode is enabled and the user is not an admin, redirect to maintenance page
if ($systemSettings['maintenance_mode'] == 1 && (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin')) {
    header('Location: maintenance.php');
    exit;
}
?>
