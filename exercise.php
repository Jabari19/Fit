<?php
include 'config.php';

// Fetch all exercises
$sql = "SELECT * FROM Exercises";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$exercises = $stmt->fetchAll();
?>

<h2>Exercises</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
    </tr>
    <?php foreach ($exercises as $exercise): ?>
    <tr>
        <td><?php echo $exercise['name']; ?></td>
        <td><?php echo $exercise['category']; ?></td>
        <td><?php echo $exercise['description']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
