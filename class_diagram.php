<?php

class Employee {
    public $id;            // INT - Primary Key
    public $name;          // VARCHAR(100) - Not Null
    public $department;    // VARCHAR(100) - Not Null
    public $role;          // VARCHAR(100) - Not Null
}

class Task {
    public $id;             // INT - Primary Key
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $description;    // TEXT - Not Null
    public $status;         // ENUM('Pending', 'Completed') - Default 'Pending'
    public $created_at;     // TIMESTAMP - Default CURRENT_TIMESTAMP
}

class Attendance {
    public $id;             // INT - Primary Key
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $date;           // DATE
    public $status;         // ENUM('Present', 'Absent', 'Leave') - Not Null
}

class TaskRating {
    public $id;             // INT - Primary Key
    public $task_id;        // INT - Foreign Key (references Task)
    public $rating;         // INT - Must be between 1 and 5
}

class User {
    public $id;             // INT - Primary Key
    public $username;       // VARCHAR(100) - Not Null, Unique
    public $password;       // VARCHAR(255) - Not Null
    public $role;           // ENUM('Admin', 'Manager', 'Employee') - Default 'Employee'
}

class Notification {
    public $id;             // INT - Primary Key
    public $user_id;        // INT - Foreign Key (references User)
    public $message;        // TEXT
    public $status;         // ENUM('Unread', 'Read') - Default 'Unread'
    public $created_at;     // TIMESTAMP - Default CURRENT_TIMESTAMP
}

class LeaveRequest {
    public $id;             // INT - Primary Key
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $start_date;     // DATE
    public $end_date;       // DATE
    public $reason;         // TEXT
    public $status;         // ENUM('Pending', 'Approved', 'Rejected') - Default 'Pending'
}

class TimeLog {
    public $id;             // INT - Primary Key
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $clock_in;       // TIMESTAMP - Not Null, Default CURRENT_TIMESTAMP
    public $clock_out;      // TIMESTAMP - Nullable, Default NULL
    public $duration;       // TIME - Calculated as the difference between clock_out and clock_in
}

class Document {
    public $id;             // INT - Primary Key
    public $task_id;        // INT - Foreign Key (references Task)
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $document_name;  // VARCHAR(255)
    public $document_path;  // VARCHAR(255)
    public $uploaded_at;    // TIMESTAMP - Default CURRENT_TIMESTAMP
}

class Message {
    public $id;             // INT - Primary Key
    public $sender_id;      // INT - Foreign Key (references User)
    public $receiver_id;    // INT - Foreign Key (references User)
    public $message;        // TEXT
    public $sent_at;        // TIMESTAMP - Default CURRENT_TIMESTAMP
}

class PerformanceReview {
    public $id;             // INT - Primary Key
    public $employee_id;    // INT - Foreign Key (references Employee)
    public $rating;         // INT - Must be between 1 and 5
    public $comments;       // TEXT
    public $review_date;    // DATE
    public $reviewer_id;    // INT - Foreign Key (references User)
}

// Output the structure in a simple way to visualize
echo '<h1>Class Diagram Representation</h1>';
echo '<pre>';
echo 'Employee, Task, Attendance, TaskRating, User, Notification, LeaveRequest, TimeLog, Document, Message, PerformanceReview';
echo '</pre>';
?>
