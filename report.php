<?php
include 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Default report type
$reportType = $_POST['reportType'] ?? 'daily'; // Daily, Monthly, Annual, or Activity Report

$today = date('Y-m-d');
$month = date('Y-m');
$year = date('Y');
$reportData = [];

// Check if reportType is task-related or user activity-related
if ($reportType == 'daily') {
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE DATE(created_at) = ?');
    $stmt->execute([$today]);
    $reportData = $stmt->fetchAll();
} elseif ($reportType == 'monthly') {
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE DATE_FORMAT(created_at, "%Y-%m") = ?');
    $stmt->execute([$month]);
    $reportData = $stmt->fetchAll();
} elseif ($reportType == 'annual') {
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE YEAR(created_at) = ?');
    $stmt->execute([$year]);
    $reportData = $stmt->fetchAll();
} elseif ($reportType == 'activity') {
    // Fetch user activities for the User Activity Report
    $stmt = $pdo->prepare('
        SELECT user_activities.*, users.username 
        FROM user_activities
        JOIN users ON user_activities.user_id = users.id
        ORDER BY activity_time DESC
    ');
    $stmt->execute();
    $reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Generate Report</h2>
        <form method="POST">
            <div class="form-group">
                <label for="reportType">Select Report Type:</label>
                <select name="reportType" class="form-control">
                    <option value="daily" <?= $reportType == 'daily' ? 'selected' : ''; ?>>Daily Task Report</option>
                    <option value="monthly" <?= $reportType == 'monthly' ? 'selected' : ''; ?>>Monthly Task Report</option>
                    <option value="annual" <?= $reportType == 'annual' ? 'selected' : ''; ?>>Annual Task Report</option>
                    <option value="activity" <?= $reportType == 'activity' ? 'selected' : ''; ?>>User Activity Report</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Generate Report</button>
        </form>

        <?php if ($reportType == 'activity'): ?>
            <!-- User Activity Report -->
            <h3 class="mt-4">User Activity Report</h3>
            <?php if (empty($reportData)): ?>
                <p>No user activity data found.</p>
            <?php else: ?>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Activity</th>
                            <th>Activity Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportData as $activity): ?>
                            <tr>
                                <td><?= htmlspecialchars($activity['username']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_type']) ?></td>
                                <td><?= htmlspecialchars($activity['activity_time']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php else: ?>
            <!-- Task Report -->
            <h3 class="mt-4"><?= ucfirst($reportType); ?> Task Report</h3>
            <?php if (empty($reportData)): ?>
                <p>No task data found for the selected report type.</p>
            <?php else: ?>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Priority</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportData as $task): ?>
                            <tr>
                                <td><?= $task['id']; ?></td>
                                <td><?= htmlspecialchars($task['description']); ?></td>
                                <td><?= htmlspecialchars($task['status']); ?></td>
                                <td><?= htmlspecialchars($task['employee_id']); ?></td>
                                <td><?= htmlspecialchars($task['priority']); ?></td>
                                <td><?= htmlspecialchars($task['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
