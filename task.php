<?php
include 'db.php';
//session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$tasks = $pdo->query('SELECT t.*, e.name as employee_name FROM tasks t JOIN employees e ON t.employee_id = e.id')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tasks</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Manage Tasks</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id']; ?></td>
                        <td><?= $task['description']; ?></td>
                        <td><?= $task['employee_name']; ?></td>
                        <td><?= $task['status']; ?></td>
                        <td><?= $task['priority']; ?></td>
                        <td>
                            <a href="edit_task.php?id=<?= $task['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_task.php?id=<?= $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_task.php" class="btn btn-primary">Assign New Task</a>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
