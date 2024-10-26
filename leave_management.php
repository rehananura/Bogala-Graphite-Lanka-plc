<?php
session_start();
?>

<?php
include 'db.php';
// session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all leave requests
$stmt = $pdo->query('SELECT l.*, e.name as employee_name FROM leaves l JOIN employees e ON l.employee_id = e.id');
$leave_requests = $stmt->fetchAll();

// Handle leave status updates (approve/reject)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['leave_id'])) {
    $action = $_POST['action'];
    $leave_id = $_POST['leave_id'];
    $status = $action === 'approve' ? 'Approved' : 'Rejected';

    $stmt = $pdo->prepare('UPDATE leaves SET status = ? WHERE id = ?');
    $stmt->execute([$status, $leave_id]);

    header('Location: leave_management.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Leave Management</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leave_requests as $leave): ?>
                    <tr>
                        <td><?= $leave['id']; ?></td>
                        <td><?= $leave['employee_name']; ?></td>
                        <td><?= $leave['leave_type']; ?></td>
                        <td><?= $leave['start_date']; ?></td>
                        <td><?= $leave['end_date']; ?></td>
                        <td><?= $leave['reason']; ?></td>
                        <td><?= $leave['status']; ?></td>
                        <td>
                            <?php if ($leave['status'] == 'Pending'): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="leave_id" value="<?= $leave['id']; ?>">
                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted"><?= $leave['status']; ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_leave.php" class="btn btn-primary">Request Leave</a>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
