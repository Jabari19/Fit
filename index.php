<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Determine the user role (admin or regular user)
$is_admin = ($_SESSION['role'] == 'admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker - Home</title>
</head>
<body>

    <h1>Welcome to the Fitness Tracker</h1>

    <?php if ($is_admin): ?>
        <!-- Admin Dashboard -->
        <h2>Admin Dashboard</h2>
        <p>As an admin, you can manage users, view workouts, and more.</p>
        <ul>
            <li><a href="workouts.php">View All Workouts</a></li>
            <li><a href="user-management.php">Manage Users</a></li>
            <li><a href="trainer-management.php">Manage Trainers</a></li>
            <li><a href="goals-management.php">Manage Goals</a></li>
            <li><a href="nutrition-management.php">Manage Nutrition</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    <?php else: ?>
        <!-- Regular User Dashboard -->
        <h2>User Dashboard</h2>
        <p>Welcome, <?php echo $_SESSION['first_name']; ?>! Here are your workouts and progress.</p>
        <ul>
            <li><a href="workouts.php">Log New Workout</a></li>
            <li><a href="workout-history.php">View Workout History</a></li>
            <li><a href="nutrition.php">Log Meals</a></li>
            <li><a href="goals.php">Set and View Goals</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>

</body>
</html>
