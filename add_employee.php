<?php
include 'db.php';
//session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $role = $_POST['role'];
    $stmt = $pdo->prepare('INSERT INTO employees (name, department, role) VALUES (?, ?, ?)');
    $stmt->execute([$name, $department, $role]);
    header('Location: employee.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Add Employee</button>
        </form>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
