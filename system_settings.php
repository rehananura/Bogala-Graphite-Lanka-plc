<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<?php
// system_settings.php

include 'db.php';
//session_start();

// Check if the user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

// Fetch current settings from the system_settings table
$stmt = $pdo->prepare('SELECT * FROM system_settings WHERE id = 1');
$stmt->execute();
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission to update settings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_name = $_POST['site_name'];
    $site_description = $_POST['site_description'];
    $maintenance_mode = isset($_POST['maintenance_mode']) ? 1 : 0;

    $stmt = $pdo->prepare('UPDATE system_settings SET site_name = ?, site_description = ?, maintenance_mode = ? WHERE id = 1');
    $stmt->execute([$site_name, $site_description, $maintenance_mode]);

    echo "Settings updated!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>System Settings</h2>
        <form method="POST">
            <!-- Site Name -->
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="<?= htmlspecialchars($settings['site_name']) ?>" required>
            </div>
            <!-- Site Description -->
            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea class="form-control" id="site_description" name="site_description" rows="3" required><?= htmlspecialchars($settings['site_description']) ?></textarea>
            </div>
            <!-- Maintenance Mode -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" <?= $settings['maintenance_mode'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="maintenance_mode">Enable Maintenance Mode</label>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
        </form>
    </div>
</body>
</html>
