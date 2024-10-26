<?php
include 'db.php'; // Include the database connection

session_start();

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user based on the provided username
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify the password and set session variables
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // Store the user's role (Admin, Manager, or Employee)

        // Log the login activity
        $user_id = $_SESSION['user_id']; // Get the logged-in user ID
        $activity_type = 'Login'; // Activity type for login

        // Insert login activity into the user_activities table
        $stmt = $pdo->prepare('INSERT INTO user_activities (user_id, activity_type) VALUES (?, ?)');
        $stmt->execute([$user_id, $activity_type]);

        // Redirect based on the user's role or to the dashboard page
        header('Location: index.php'); // Redirect to the dashboard page (index.php or dashboard.php)
        exit; // Ensure no further code is executed after redirection
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Graphite Management System</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Login</button>
        </form>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
