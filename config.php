<?php
// Database connection settings
$host = 'localhost';  // Database host
$db   = 'WorkoutDB';  // Database name
$user = 'root';       // Database username
$pass = '';           // Database password (empty for localhost by default)
$charset = 'utf8mb4'; // Character set

// DSN (Data Source Name) string
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for better performance and error handling
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exception handling for errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Disable emulated prepared statements for better security
];

try {
    // Create a PDO instance and establish a connection to the database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Log error message to a file instead of exposing it to the user
    error_log("Database connection error: " . $e->getMessage(), 3, 'error_log.txt');
    
    // Optionally, redirect to a custom error page for better user experience
    die('Database connection failed. Please try again later.');
}
?>
