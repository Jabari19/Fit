<?php
// Generate and output the password hash for 'admin1234'
$password = 'admin1234';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo "The hashed password for '{$password}' is: {$hashedPassword}";
?>
