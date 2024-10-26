<?php
include 'db.php';
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

// Handle document upload and assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];

    // Handle file upload
    $file_name = $_FILES['document']['name'];
    $file_tmp = $_FILES['document']['tmp_name'];
    $file_path = 'uploads/' . basename($file_name);
    
    // Move the file to the uploads folder
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Insert document info into the database
        $stmt = $pdo->prepare('INSERT INTO documents (employee_id, file_name, file_path, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$employee_id, $file_name, $file_path, 'Pending']);
        echo "Document uploaded and assigned!";
    } else {
        echo "Failed to upload the document.";
    }
}

// Fetch all employees for the dropdown
$stmt = $pdo->query('SELECT id, username FROM employees');
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Assign Document</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload and Assign Document</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="employee_id">Assign to Employee:</label>
                <select name="employee_id" class="form-control" required>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id']; ?>"><?= htmlspecialchars($employee['username']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="document">Upload Document:</label>
                <input type="file" name="document" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload and Assign</button>
        </form>
    </div>
</body>
</html>
