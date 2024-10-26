
<?php
// Include your database connection file
include 'db.php';
session_start();  // Ensure session is started if you need session management

// Join leave_requests with employees to get employee names
$stmt = $pdo->prepare('
    SELECT leave_requests.*, employees.name AS employee_name 
    FROM leave_requests
    JOIN employees ON leave_requests.employee_id = employees.id
');
$stmt->execute();
$leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch the data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"> <!-- Link to Bootstrap for styling -->
</head>
<body>
    <div class="container mt-5">
        <h2>Leave Requests</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveRequests as $leave): ?>
                    <tr>
                        <td><?= htmlspecialchars($leave['employee_name']) ?></td>
                        <td><?= htmlspecialchars($leave['leave_type']) ?></td>
                        <td><?= htmlspecialchars($leave['start_date']) ?></td>
                        <td><?= htmlspecialchars($leave['end_date']) ?></td>
                        <td><?= htmlspecialchars($leave['reason']) ?></td>
                        <td><?= htmlspecialchars($leave['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
