<?php
include 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$notification_id = $_GET['id'];

// Mark the notification as read in the database
$stmt = $pdo->prepare('UPDATE notifications SET is_read = TRUE WHERE id = ?');
$stmt->execute([$notification_id]);

// Redirect back to the notifications page after marking it as read
header('Location: notifications.php');
exit;
?>
