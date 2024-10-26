<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$employeeId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('INSERT INTO time_logs (employee_id, clock_in) VALUES (?, NOW())');
    $stmt->execute([$employeeId]);
    header('Location: index.php');
}
?>
