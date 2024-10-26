<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$employeeId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('UPDATE time_logs SET clock_out = NOW() WHERE employee_id = ? AND clock_out IS NULL');
    $stmt->execute([$employeeId]);
    header('Location: index.php');
}
?>
