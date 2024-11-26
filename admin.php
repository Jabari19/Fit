<?php
session_start();
include 'config.php';  // Database connection

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Fetch Users
$sql_users = "SELECT * FROM Users";
$stmt_users = $pdo->prepare($sql_users);
$stmt_users->execute();
$users = $stmt_users->fetchAll();

// Fetch Workouts
$sql_workouts = "SELECT * FROM Workouts";
$stmt_workouts = $pdo->prepare($sql_workouts);
$stmt_workouts->execute();
$workouts = $stmt_workouts->fetchAll();

// Fetch Goals
$sql_goals = "SELECT * FROM Goals";
$stmt_goals = $pdo->prepare($sql_goals);
$stmt_goals->execute();
$goals = $stmt_goals->fetchAll();

// Fetch Nutrition Logs
$sql_nutrition = "SELECT * FROM Nutrition";
$stmt_nutrition = $pdo->prepare($sql_nutrition);
$stmt_nutrition->execute();
$nutrition = $stmt_nutrition->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>
    <p>As an admin, you can view and manage data below.</p>

    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Age</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['user_id']; ?></td>
            <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td><?php echo $user['age']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Workouts</h2>
    <table border="1">
        <tr>
            <th>Workout ID</th>
            <th>User ID</th>
            <th>Date</th>
            <th>Duration (minutes)</th>
        </tr>
        <?php foreach ($workouts as $workout): ?>
        <tr>
            <td><?php echo $workout['workout_id']; ?></td>
            <td><?php echo $workout['user_id']; ?></td>
            <td><?php echo $workout['date']; ?></td>
            <td><?php echo $workout['duration']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Goals</h2>
    <table border="1">
        <tr>
            <th>Goal ID</th>
            <th>User ID</th>
            <th>Goal Type</th>
            <th>Target Value</th>
            <th>Progress</th>
        </tr>
        <?php foreach ($goals as $goal): ?>
        <tr>
            <td><?php echo $goal['goal_id']; ?></td>
            <td><?php echo $goal['user_id']; ?></td>
            <td><?php echo $goal['goal_type']; ?></td>
            <td><?php echo $goal['target_value']; ?></td>
            <td><?php echo $goal['progress']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Nutrition Logs</h2>
    <table border="1">
        <tr>
            <th>Nutrition ID</th>
            <th>User ID</th>
            <th>Meal Type</th>
            <th>Calories</th>
            <th>Date</th>
        </tr>
        <?php foreach ($nutrition as $meal): ?>
        <tr>
            <td><?php echo $meal['nutrition_id']; ?></td>
            <td><?php echo $meal['user_id']; ?></td>
            <td><?php echo $meal['meal_type']; ?></td>
            <td><?php echo $meal['calories']; ?></td>
            <td><?php echo $meal['date']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
