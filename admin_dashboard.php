<?php
include 'config.php'; // Include the database configuration
session_start();

// Ensure the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirect to login if not an admin
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Welcome to the Admin Dashboard</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! You can manage the users, workouts, and other settings below.</p>

    <ul>
        <li><a href="user-management.php">Manage Users</a></li>
        <li><a href="workout-management.php">Manage Workouts</a></li>
        <li><a href="nutrition-management.php">Manage Nutrition</a></li>
        <li><a href="trainer-management.php">Manage Trainers</a></li>
        <li><a href="goals-management.php">Manage Goals</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</body>
</html>
