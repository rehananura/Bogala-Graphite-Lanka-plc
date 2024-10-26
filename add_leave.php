<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <style>
        /* Styling for suggestion box */
        .suggestion-box {
            border: 1px solid #ccc;
            background-color: #fff;
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
        }

        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Request Leave</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group position-relative">
                <label for="employee_name">Employee Name:</label>
                <input type="text" id="employee_name" name="employee_name" class="form-control" required>
                <div id="suggestions" class="suggestion-box"></div>
            </div>
            <div class="form-group">
                <label for="leave_type">Leave Type:</label>
                <select name="leave_type" class="form-control" required>
                    <option value="" disabled selected>Select Leave Type</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Annual Leave">Annual Leave</option>
                    <option value="Casual Leave">Casual Leave</option>
                    <option value="Maternity Leave">Maternity Leave</option>
                    <option value="Paternity Leave">Paternity Leave</option>
                    <option value="Bereavement Leave">Bereavement Leave</option>
                    <option value="Study Leave">Study Leave</option>
                    <option value="Unpaid Leave">Unpaid Leave</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea name="reason" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit Leave Request</button>
        </form>
    </div>
    
    <!-- JavaScript for handling suggestions -->
    <script>
        document.getElementById('employee_name').addEventListener('input', function() {
            const query = this.value;
            if (query.length >= 2) { // Only search if more than 2 characters
                fetch('search_employee.php?query=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsBox = document.getElementById('suggestions');
                        suggestionsBox.innerHTML = ''; // Clear previous suggestions

                        if (data && Array.isArray(data)) {
                            data.forEach(item => {
                                const suggestion = document.createElement('div');
                                suggestion.textContent = item.name;
                                suggestion.className = 'suggestion-item';
                                suggestion.style.cursor = 'pointer';
                                suggestion.style.padding = '8px';
                                suggestion.style.borderBottom = '1px solid #ccc';
                                
                                suggestion.addEventListener('click', function() {
                                    document.getElementById('employee_name').value = this.textContent;
                                    suggestionsBox.innerHTML = ''; // Clear suggestions after selection
                                });
                                
                                suggestionsBox.appendChild(suggestion);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        });

        // Close suggestions if clicked outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.form-group')) {
                document.getElementById('suggestions').innerHTML = '';
            }
        });
    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
