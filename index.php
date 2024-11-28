<?php
include 'config.php';
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 1rem 2rem;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 10;
        }
        header h1 {
            margin: 0;
            padding: 0.5rem;
        }
        nav {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 60px;
            width: 100%;
            z-index: 9;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            padding: 14px 16px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        main {
            padding: 3rem 2rem;
            max-width: 900px;
            margin: 80px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
        p {
            line-height: 1.6;
            font-size: 16px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 0.5rem 0;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .feature-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        .feature-box h3 {
            margin-top: 0;
            color: #007bff;
        }
        @media (max-width: 768px) {
            nav a {
                float: none;
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Fitness Tracker</h1>
</header>

<nav>
    
    <a class="btn" href="logout.php">Logout</a>
</nav>

<main>
    <?php if ($is_admin): ?>
        <h2>Admin Dashboard</h2>
        <p>As an admin, you can manage users, view workouts, and more.</p>
        <div class="feature-box">
            <h3>Manage Users</h3>
            <p>View and manage all users of the system.</p>
            <a href="user-management.php" class="btn">Go to User Management</a>
        </div>
        <div class="feature-box">
            <h3>Manage Trainers</h3>
            <p>Assign and manage trainers for your users.</p>
            <a href="trainer-management.php" class="btn">Go to Trainer Management</a>
        </div>
        <div class="feature-box">
            <h3>Manage Workouts</h3>
            <p>View and edit workout logs for all users.</p>
            <a href="workouts.php" class="btn">View All Workouts</a>
        </div>
        <div class="feature-box">
            <h3>Manage Goals</h3>
            <p>Set and track fitness goals for all users.</p>
            <a href="goals-management.php" class="btn">Manage Goals</a>
        </div>
        <div class="feature-box">
            <h3>Manage Nutrition</h3>
            <p>Track and manage nutrition information for all users.</p>
            <a href="nutrition-management.php" class="btn">Manage Nutrition</a>
        </div>
    <?php else: ?>
        <h2>User Dashboard</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! Here are your workouts and progress.</p>
        <div class="feature-box">
            <h3>Log New Workout</h3>
            <p>Record a new workout session and track your progress.</p>
            <a href="workouts.php" class="btn">Log New Workout</a>
        </div>
        <div class="feature-box">
            <h3>View Workout History</h3>
            <p>Check your workout history and see how far you've come.</p>
            <a href="workout-history.php" class="btn">View History</a>
        </div>
        <div class="feature-box">
            <h3>Log Meals</h3>
            <p>Track your meals and ensure you're meeting your nutrition goals.</p>
            <a href="nutrition.php" class="btn">Log Meals</a>
        </div>
        <div class="feature-box">
            <h3>Set and View Goals</h3>
            <p>Set personalized fitness goals and track your achievements.</p>
            <a href="goals.php" class="btn">View Goals</a>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
