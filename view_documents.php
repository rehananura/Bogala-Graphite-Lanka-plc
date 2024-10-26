<?php
include 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch documents assigned to the logged-in employee
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM documents WHERE employee_id = ?');
$stmt->execute([$user_id]);
$documents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assigned Documents</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Assigned Documents</h2>
        <?php if ($documents): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document): ?>
                    <tr>
                        <td><?= htmlspecialchars($document['file_name']); ?></td>
                        <td><?= htmlspecialchars($document['status']); ?></td>
                        <td>
                            <a href="uploads/<?= htmlspecialchars($document['file_name']); ?>" class="btn btn-primary" download>Download</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No documents assigned to you.</p>
        <?php endif; ?>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
