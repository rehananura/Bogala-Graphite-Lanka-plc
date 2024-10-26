<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$bestEmployee = null;
$highestScore = 0;
$employees = $pdo->query('SELECT * FROM employees')->fetchAll();

foreach ($employees as $employee) {
    $completedTasksCount = $pdo->query("SELECT COUNT(*) FROM tasks WHERE employee_id = {$employee['id']} AND status = 'Completed'")->fetchColumn();
    $attendanceCount = $pdo->query("SELECT COUNT(*) FROM attendance WHERE employee_id = {$employee['id']} AND status = 'Present'")->fetchColumn();
    $leavesCount = $pdo->query("SELECT COUNT(*) FROM attendance WHERE employee_id = {$employee['id']} AND status = 'Leave'")->fetchColumn();

    $score = ($completedTasksCount * 2) + $attendanceCount - ($leavesCount * 1.5);

    if ($score > $highestScore) {
        $highestScore = $score;
        $bestEmployee = $employee;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee of the Month</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Employee of the Month</h2>
        <?php if ($bestEmployee): ?>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $bestEmployee['name']; ?></h5>
                    <p class="card-text">
                        Department: <?= $bestEmployee['department']; ?><br>
                        Role: <?= $bestEmployee['role']; ?><br>
                        Completed Tasks: <?= $completedTasksCount; ?><br>
                        Attendance: <?= $attendanceCount; ?><br>
                        Leaves: <?= $leavesCount; ?><br>
                        Score: <?= $highestScore; ?>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <p>No employee data available for this month.</p>
        <?php endif; ?>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
