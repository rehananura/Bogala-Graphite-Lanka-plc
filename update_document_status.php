<?php
include 'db.php';
session_start();  // Ensure session is started

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $document_id = $_POST['document_id'];
    $new_status = $_POST['status'];

    // Update the document status in the database
    $stmt = $pdo->prepare('UPDATE documents SET status = ? WHERE id = ?');
    $stmt->execute([$new_status, $document_id]);

    // Fetch the user ID of the admin/manager who assigned the document
    $stmt = $pdo->prepare('SELECT assigned_by FROM documents WHERE id = ?');
    $stmt->execute([$document_id]);
    $assigner = $stmt->fetch();

    // Insert a notification for the assigner when the document is marked as completed
    if ($new_status === 'Completed') {
        $message = "Document ID $document_id has been marked as completed.";
        $stmt = $pdo->prepare('INSERT INTO notifications (user_id, message, document_id, created_at, is_read) VALUES (?, ?, ?, NOW(), 0)');
        $stmt->execute([$assigner['assigned_by'], $message, $document_id]);
    }

    // Redirect back to the dashboard
    header('Location: index.php');
    exit;
}
