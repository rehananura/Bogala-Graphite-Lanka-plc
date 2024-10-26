<?php
// Replace 'password123' with the password you want to hash.
$password = 'test123';

// Use password_hash() to hash the password with the default bcrypt algorithm.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Display the hashed password.
echo 'Hashed Password: ' . $hashed_password;
?>
