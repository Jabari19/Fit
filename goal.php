<?php
include 'config.php'; 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Insert new goal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goal_description = $_POST['goal_description'];
    $target_date = $_POST['target_date'];

    $sql = "INSERT INTO Goals (user_id, goal_description, target_date) 
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $goal_description, $target_date]);

    echo "Goal added successfully!";
}

// Fetch existing goals
$sql = "SELECT * FROM Goals WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$goals = $stmt->fetchAll();
?>

<h2>Your Goals</h2>
<form method="POST">
    <label>Goal Description: <input type="text" name="goal_description" required></label><br>
    <label>Target Date: <input type="date" name="target_date" required></label><br>
    <button type="submit">Set Goal</button>
</form>

<h3>Current Goals</h3>
<table>
    <tr>
        <th>Goal Description</th>
        <th>Target Date</th>
    </tr>
    <?php foreach ($goals as $goal): ?>
    <tr>
        <td><?php echo $goal['goal_description']; ?></td>
        <td><?php echo $goal['target_date']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
