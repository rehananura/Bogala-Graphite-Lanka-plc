<?php
include 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

// Get the document ID and notification ID from the URL
$document_id = $_GET['document_id'];
$notification_id = $_GET['notification_id'];

// Mark the notification as read
$stmt = $pdo->prepare('UPDATE notifications SET is_read = TRUE WHERE id = ?');
$stmt->execute([$notification_id]);

// Redirect to the document view page or any other relevant page
header("Location: view_documents.php?document_id=$document_id");
exit;
?>
