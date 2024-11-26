<?php
include 'config.php'; 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Insert new meal log
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meal = $_POST['meal'];
    $calories = $_POST['calories'];
    $protein = $_POST['protein'];
    $fat = $_POST['fat'];
    $carbs = $_POST['carbs'];
    $date = $_POST['date'];

    $sql = "INSERT INTO Nutrition (user_id, meal, calories, protein, fat, carbs, date) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $meal, $calories, $protein, $fat, $carbs, $date]);

    echo "Meal logged successfully!";
}

// Fetch existing nutrition logs
$sql = "SELECT * FROM Nutrition WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$nutritionLogs = $stmt->fetchAll();
?>

<h2>Your Nutrition Logs</h2>
<form method="POST">
    <label>Meal: <input type="text" name="meal" required></label><br>
    <label>Calories: <input type="number" name="calories" required></label><br>
    <label>Protein (g): <input type="number" name="protein" required></label><br>
    <label>Fat (g): <input type="number" name="fat" required></label><br>
    <label>Carbs (g): <input type="number" name="carbs" required></label><br>
    <label>Date: <input type="datetime-local" name="date" required></label><br>
    <button type="submit">Log Meal</button>
</form>

<h3>Past Nutrition Logs</h3>
<table>
    <tr>
        <th>Meal</th>
        <th>Calories</th>
        <th>Protein</th>
        <th>Fat</th>
        <th>Carbs</th>
        <th>Date</th>
    </tr>
    <?php foreach ($nutritionLogs as $log): ?>
    <tr>
        <td><?php echo $log['meal']; ?></td>
        <td><?php echo $log['calories']; ?></td>
        <td><?php echo $log['protein']; ?>g</td>
        <td><?php echo $log['fat']; ?>g</td>
        <td><?php echo $log['carbs']; ?>g</td>
        <td><?php echo $log['date']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
