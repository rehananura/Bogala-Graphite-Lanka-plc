<?php
include 'db.php'; // Include database connection
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch messages for the logged-in user
$stmt = $pdo->prepare('SELECT m.id, m.message, m.sent_at, u.username AS sender
                       FROM messages m
                       JOIN users u ON m.sender_id = u.id
                       WHERE m.receiver_id = ?');
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2>Messages</h2>
    <?php if ($messages): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= htmlspecialchars($message['id']) ?></td>
                        <td><?= htmlspecialchars($message['sender']) ?></td>
                        <td><?= htmlspecialchars($message['message']) ?></td>
                        <td><?= htmlspecialchars($message['sent_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
