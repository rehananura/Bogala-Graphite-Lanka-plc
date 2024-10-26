<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

$task_id = $_GET['id'] ?? null;

if (!$task_id) {
    header('Location: task.php');
    exit;
}

// Fetch the task data from the database
$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$task_id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = isset($_POST['task_name']) ? $_POST['task_name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : '';

    if (!empty($task_name) && !empty($description) && !empty($due_date)) {
        // Update task in the database
        $stmt = $pdo->prepare('UPDATE tasks SET task_name = ?, description = ?, due_date = ? WHERE id = ?');
        $stmt->execute([$task_name, $description, $due_date, $task_id]);
        header('Location: task.php');
        exit;
    } else {
        echo 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Task</h2>
        <form method="POST">
            <div class="form-group">
                <label for="task_name">Task Name:</label>
                <input type="text" name="task_name" class="form-control" value="<?= htmlspecialchars($task['task_name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required><?= htmlspecialchars($task['description'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" class="form-control" value="<?= htmlspecialchars($task['due_date'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
</body>
</html>
