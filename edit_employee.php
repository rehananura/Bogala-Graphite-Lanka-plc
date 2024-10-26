<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE id = ?');
    $stmt->execute([$id]);
    $employee = $stmt->fetch();
    if (!$employee) {
        echo "Employee not found!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $role = $_POST['role'];
    $stmt = $pdo->prepare('UPDATE employees SET name = ?, department = ?, role = ? WHERE id = ?');
    $stmt->execute([$name, $department, $role, $id]);
    header('Location: employee.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Edit Employee</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?= $employee['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" class="form-control" value="<?= $employee['department'] ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" class="form-control" value="<?= $employee['role'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Employee</button>
        </form>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
