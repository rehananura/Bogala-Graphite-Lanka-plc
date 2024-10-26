<?php
include 'db.php';
//session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$employees = $pdo->query('SELECT * FROM employees')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Manage Employees</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['id']; ?></td>
                        <td><?= $employee['name']; ?></td>
                        <td><?= $employee['department']; ?></td>
                        <td><?= $employee['role']; ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?= $employee['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_employee.php?id=<?= $employee['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_employee.php" class="btn btn-primary">Add New Employee</a>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
