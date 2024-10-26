<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';
session_start();

// Ensure only admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

// Fetch all user activities along with the username from the users table
$stmt = $pdo->prepare('
    SELECT user_activities.*, users.username 
    FROM user_activities
    JOIN users ON user_activities.user_id = users.id
    ORDER BY activity_time DESC
');
$stmt->execute();
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debugging: Use var_dump to check data if necessary
// var_dump($activities);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Report</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Activity Report</h2>

        <?php if (empty($activities)): ?>
            <p>No activities to display.</p>
        <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Activity</th>
                    <th>Activity Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?= htmlspecialchars($activity['username']) ?></td>
                        <td><?= htmlspecialchars($activity['activity_type']) ?></td>
                        <td><?= htmlspecialchars($activity['activity_time']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</body>
</html>
