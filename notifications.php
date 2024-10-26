<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role']; // Fetch the user's role

// Fetch notifications for the logged-in user (Admin or Manager only sees their own assigned task notifications)
if ($role === 'Admin' || $role === 'Manager') {
    // Admin and Manager can view notifications related to tasks they assigned
    $stmt = $pdo->prepare('SELECT * FROM notifications WHERE (user_id = ? OR user_id IS NULL) ORDER BY created_at DESC');
} else {
    // Employees only see their own notifications
    $stmt = $pdo->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC');
}

$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2>Notifications</h2>
    <?php if ($notifications): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notifications as $notification): ?>
                    <tr>
                        <td><?= htmlspecialchars($notification['id']) ?></td>
                        <td><?= htmlspecialchars($notification['message']) ?></td>
                        <td><?= $notification['is_read'] ? 'Read' : 'Unread'; ?></td>
                        <td><?= htmlspecialchars($notification['created_at']) ?></td>
                        <td>
                            <?php if (!$notification['is_read']): ?>
                                <!-- Mark as read -->
                                <a href="mark_notification_read.php?id=<?= $notification['id'] ?>" class="btn btn-primary btn-sm">Mark as Read</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No notifications found.</p>
    <?php endif; ?>
</div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
