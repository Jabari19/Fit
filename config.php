<?php
// Database configuration
$host = 'localhost'; // Database host (usually localhost for local development)
$dbname = 'WorkoutDB'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password (leave empty for default local setup)

// Create a PDO instance and set options
try {
    // Create the PDO instance for MySQL database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO error mode to exception to handle errors more easily
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any connection errors by displaying the error message
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
