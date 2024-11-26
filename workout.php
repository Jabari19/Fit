<?php
include 'config.php'; 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Insert new workout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    
    $sql = "INSERT INTO Workouts (user_id, date, duration) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $date, $duration]);

    echo "Workout logged successfully!";
}

// Fetch existing workouts
$sql = "SELECT * FROM Workouts WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$workouts = $stmt->fetchAll();
?>

<h2>Your Workouts</h2>
<form method="POST">
    <label>Date: <input type="datetime-local" name="date" required></label><br>
    <label>Duration (minutes): <input type="number" name="duration" required></label><br>
    <button type="submit">Log Workout</button>
</form>

<h3>Past Workouts</h3>
<table>
    <tr>
        <th>Date</th>
        <th>Duration (minutes)</th>
    </tr>
    <?php foreach ($workouts as $workout): ?>
    <tr>
        <td><?php echo $workout['date']; ?></td>
        <td><?php echo $workout['duration']; ?> mins</td>
    </tr>
    <?php endforeach; ?>
</table>
