<?php
//session_start();
?>

<?php
// Get the current filename for active state
$current_page = basename($_SERVER['PHP_SELF']);
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <style>
        /* Light and Dark Theme Styles */
        body.dark-theme {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-theme .navbar {
            background-color: #333;
        }

        body.dark-theme .card {
            background-color: #1e1e1e;
            color: #e0e0e0;
            border-color: #333;
        }

        body.dark-theme .table {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        body.dark-theme .form-control {
            background-color: #2a2a2a;
            color: #e0e0e0;
            border-color: #444;
        }

        body.dark-theme .btn-primary {
            background-color: #0056b3;
            border-color: #004494;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Bogala Graphite Lanka PLC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'employee.php' ? 'active' : '' ?>" href="employee.php">Manage Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'task.php' ? 'active' : '' ?>" href="task.php">Task Assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'leave_management.php' ? 'active' : '' ?>" href="leave_management.php">Leave Management</a>
                </li>
                
                <?php if ($_SESSION['role'] === 'Admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'user_management.php' ? 'active' : '' ?>" href="user_management.php">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'system_settings.php' ? 'active' : '' ?>" href="system_settings.php">System Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'report.php' ? 'active' : '' ?>" href="report.php">Generate Report</a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'calculate_employee_of_month.php' ? 'active' : '' ?>" href="calculate_employee_of_month.php">Employee of the Month</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <div class="d-flex">
                        <button id="increase-font" class="btn btn-sm btn-outline-light me-1">A+</button>
                        <button id="decrease-font" class="btn btn-sm btn-outline-light">A-</button>
                    </div>
                </li>
                <li class="nav-item me-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="theme-toggle">
                        <label class="form-check-label text-white" for="theme-toggle">Dark Mode</label>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'messages.php' ? 'active' : '' ?>" href="messages.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'notifications.php' ? 'active' : '' ?>" href="notifications.php">Notifications</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- JavaScript for Font Size Adjustment and Theme Toggle -->
<script>
    // Default font size
    let fontSize = 16;

    // Increase font size
    document.getElementById('increase-font').addEventListener('click', function () {
        fontSize = Math.min(fontSize + 1, 22); // Set a max font size
        document.body.style.fontSize = fontSize + 'px';
    });

    // Decrease font size
    document.getElementById('decrease-font').addEventListener('click', function () {
        fontSize = Math.max(fontSize - 1, 12); // Set a min font size
        document.body.style.fontSize = fontSize + 'px';
    });

    // Theme toggle switch
    const themeToggle = document.getElementById('theme-toggle');

    // Load theme from local storage if available
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-theme');
        themeToggle.checked = true;
    }

    themeToggle.addEventListener('change', function () {
        if (themeToggle.checked) {
            document.body.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-theme');
            localStorage.setItem('theme', 'light');
        }
    });
</script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
