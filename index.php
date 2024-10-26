<?php 
include 'db.php'; 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Check if the user is an admin
$isAdmin = ($role === 'Admin');

// Fetch counts for dashboard statistics
$totalEmployees = $pdo->query('SELECT COUNT(*) FROM employees')->fetchColumn();
$totalTasks = $pdo->query('SELECT COUNT(*) FROM tasks')->fetchColumn();
$pendingTasks = $pdo->query("SELECT COUNT(*) FROM tasks WHERE status = 'Pending'")->fetchColumn();
$completedTasks = $pdo->query("SELECT COUNT(*) FROM tasks WHERE status = 'Completed'")->fetchColumn();

// Fetch unread notifications for the admin
$notifications = [];
if ($isAdmin) {
    $stmt = $pdo->query('SELECT * FROM notifications WHERE is_read = 0 ORDER BY created_at DESC');
    $notifications = $stmt->fetchAll();
}

// Handle document upload and assignment for admins
if ($isAdmin && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_document'])) {
    $employee_id = $_POST['employee_id'];
    $task_id = $_POST['task_id']; // Task ID field

    // Handle file upload
    $file_name = $_FILES['document']['name'];
    $file_tmp = $_FILES['document']['tmp_name'];
    $file_path = 'uploads/' . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        // Insert document info into the database
        $stmt = $pdo->prepare('INSERT INTO documents (task_id, employee_id, document_name, document_path, uploaded_at, status) VALUES (?, ?, ?, ?, NOW(), "Pending")');
        $stmt->execute([$task_id, $employee_id, $file_name, $file_path]);
        echo "<div class='alert alert-success'>Document uploaded and assigned successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to upload the document.</div>";
    }
}

// Fetch all employees and tasks for dropdowns
$employees = $pdo->query('SELECT id, name FROM employees')->fetchAll();
$tasks = $pdo->query('SELECT id, description FROM tasks')->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphite Management Dashboard</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="#">Graphite Management</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav ml-auto">
           <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Notifications (<?= count($notifications); ?>)
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <?php if ($notifications): ?>
                       <?php foreach ($notifications as $notification): ?>
                           <a class="dropdown-item" href="view_document.php?id=<?= $notification['document_id']; ?>">
                               <?= htmlspecialchars($notification['message']); ?>
                           </a>
                       <?php endforeach; ?>
                   <?php else: ?>
                       <a class="dropdown-item">No new notifications</a>
                   <?php endif; ?>
               </div>
           </li>
       </ul>
   </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Graphite Management Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <p class="card-text"><?= $totalEmployees; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks</h5>
                    <p class="card-text"><?= $totalTasks; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text"><?= $pendingTasks; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text"><?= $completedTasks; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <nav class="mt-4">
        <a href="employee.php" class="btn btn-primary">Manage Employees</a>
        <a href="task.php" class="btn btn-primary">Task Assignment</a>
        <a href="report.php" class="btn btn-primary">Generate Report</a>
        <a href="calculate_employee_of_month.php" class="btn btn-primary">Employee of the Month</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </nav>

    <!-- Document Upload Section for Admin -->
    <?php if ($isAdmin): ?>
    <h3 class="mt-5">Upload and Assign Documents</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="employee_id">Assign to Employee:</label>
            <select name="employee_id" class="form-control" required>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?= $employee['id']; ?>"><?= htmlspecialchars($employee['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="task_id">Assign to Task:</label>
            <select name="task_id" class="form-control" required>
                <?php foreach ($tasks as $task): ?>
                    <option value="<?= $task['id']; ?>"><?= htmlspecialchars($task['description']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="document">Upload Document:</label>
            <input type="file" name="document" class="form-control" required>
        </div>
        <button type="submit" name="upload_document" class="btn btn-primary mt-2">Upload and Assign</button>
    </form>
    <?php endif; ?>

    <!-- Employee View Assigned Documents -->
    <?php if (!$isAdmin): ?>
    <h3 class="mt-5">Your Assigned Documents</h3>
    <?php
        // Fetch documents assigned to the logged-in employee
        $stmt = $pdo->prepare('SELECT * FROM documents WHERE employee_id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $assignedDocuments = $stmt->fetchAll();
    ?>
    <?php if ($assignedDocuments): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Name</th>
                <th>View</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignedDocuments as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['document_name']); ?></td>
                    <td><a href="<?= $document['document_path']; ?>" target="_blank">View</a></td>
                    <td><?= htmlspecialchars($document['status']); ?></td>
                    <td>
                        <form method="POST" action="update_document_status.php">
                            <input type="hidden" name="document_id" value="<?= $document['id']; ?>">
                            <select name="status" class="form-control" required>
                                <option value="Pending" <?= $document['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="In Progress" <?= $document['status'] === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                <option value="Completed" <?= $document['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                            <button type="submit" class="btn btn-secondary mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No documents assigned.</p>
    <?php endif; ?>
    <?php endif; ?>
</div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
