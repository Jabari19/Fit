<?php
include 'config.php'; 
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Add new trainer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $certification = $_POST['certification'];

    // Insert the new trainer into the Trainers table
    $sql = "INSERT INTO Trainers (first_name, last_name, certification) 
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $certification]);

    echo "Trainer added successfully!";
}

// Fetch all trainers from the database
$sql = "SELECT * FROM Trainers";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$trainers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Management</title>
</head>
<body>

<h2>Trainer Management</h2>

<!-- Form to add a new trainer -->
<form method="POST">
    <label>First Name: <input type="text" name="first_name" required></label><br>
    <label>Last Name: <input type="text" name="last_name" required></label><br>
    <label>Certification: <input type="text" name="certification" required></label><br>
    <button type="submit">Add Trainer</button>
</form>

<h3>Trainers</h3>

<!-- Table to display trainers -->
<table border="1">
    <tr>
        <th>Name</th>
        <th>Certification</th>
    </tr>
    <?php foreach ($trainers as $trainer): ?>
    <tr>
        <td><?php echo $trainer['first_name'] . ' ' . $trainer['last_name']; ?></td>
        <td><?php echo $trainer['certification']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
