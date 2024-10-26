<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch employees for task assignment
$employees = $pdo->query('SELECT * FROM employees')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    
    // Insert a new task into the database
    $stmt = $pdo->prepare('INSERT INTO tasks (employee_id, description, priority) VALUES (?, ?, ?)');
    $stmt->execute([$employee_id, $description, $priority]);

    header('Location: task.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign New Task</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Assign New Task</h2>
        <form method="POST">
            <div class="form-group">
                <label for="employee_id">Assign To:</label>
                <select name="employee_id" class="form-control" required>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select name="priority" class="form-control" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Assign Task</button>
        </form>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
