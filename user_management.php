<?php
include 'db.php';
//session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

// Fetch all users who are not soft-deleted
$stmt = $pdo->prepare('SELECT * FROM users WHERE deleted = 0');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];

        // Soft delete the user by setting the 'deleted' field to 1
        $stmt = $pdo->prepare('UPDATE users SET deleted = 1 WHERE id = ?');
        $stmt->execute([$user_id]);

        // Redirect back to the user management page
        header('Location: user_management.php');
        exit;
    }

    if (isset($_POST['restore_user'])) {
        $user_id = $_POST['user_id'];

        // Restore the user by setting the 'deleted' field to 0
        $stmt = $pdo->prepare('UPDATE users SET deleted = 0 WHERE id = ?');
        $stmt->execute([$user_id]);

        // Redirect back to the user management page
        header('Location: user_management.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>User Management</h2>
        <a href="add_user.php" class="btn btn-success mb-3">Add User</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning">Edit</a>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Deleted Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all users who are soft-deleted
                $stmt = $pdo->prepare('SELECT * FROM users WHERE deleted = 1');
                $stmt->execute();
                $deleted_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($deleted_users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <button type="submit" name="restore_user" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
