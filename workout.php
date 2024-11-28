<?php
include 'config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's workouts
$sql = "SELECT * FROM Workouts WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$workouts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workouts</title>
</head>
<body>
    <h1>Your Workouts</h1>
    <a href="add_workout.php">Add New Workout</a>
    <ul>
        <?php foreach ($workouts as $workout): ?>
            <li><?php echo $workout['workout_date']; ?> - <?php echo htmlspecialchars($workout['workout_details']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
