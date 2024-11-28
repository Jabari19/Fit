<?php
include 'config.php';

// Fetch trainers
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
    <title>Trainers</title>
</head>
<body>
    <h1>Available Trainers</h1>
    <ul>
        <?php foreach ($trainers as $trainer): ?>
            <li>
                <?php echo $trainer['name']; ?> - <?php echo $trainer['specialization']; ?> (Contact: <?php echo $trainer['contact_info']; ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
