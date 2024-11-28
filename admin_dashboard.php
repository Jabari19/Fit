<?php
include 'config.php';
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not admin
    exit;
}

// Fetch system stats, like the number of users, workouts, etc.
$sql_users = "SELECT COUNT(*) AS total_users FROM Users";
$stmt = $pdo->prepare($sql_users);
$stmt->execute();
$total_users = $stmt->fetch()['total_users'];

$sql_workouts = "SELECT COUNT(*) AS total_workouts FROM Workouts";
$stmt = $pdo->prepare($sql_workouts);
$stmt->execute();
$total_workouts = $stmt->fetch()['total_workouts'];

// Example: Additional stats (if you have any)
$sql_goals = "SELECT COUNT(*) AS total_goals FROM Goals";
$stmt = $pdo->prepare($sql_goals);
$stmt->execute();
$total_goals = $stmt->fetch()['total_goals'];
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
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .stats div {
            background: #4CAF50;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }
        .stats div h2 {
            margin: 0;
            font-size: 1.5em;
        }
        .stats div p {
            font-size: 1.2em;
            margin-top: 10px;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
        }
        .actions a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 20px;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            margin: 0 10px;
        }
        .actions a:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome, Admin</h1>
        <p>Here you can manage the system, users, and settings.</p>

        <!-- System Stats Section -->
        <div class="stats">
            <div>
                <h2>Users</h2>
                <p><?php echo $total_users; ?></p>
            </div>
            <div>
                <h2>Workouts</h2>
                <p><?php echo $total_workouts; ?></p>
            </div>
            <div>
                <h2>Goals</h2>
                <p><?php echo $total_goals; ?></p>
            </div>
        </div>

        <!-- Admin Actions Section -->
        <div class="actions">
            <a href="admin_users.php">Manage Users</a>
            <a href="admin_settings.php">Settings</a>
            <a href="admin_reports.php">View Reports</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
