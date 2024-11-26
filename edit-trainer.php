<?php
include 'config.php'; 
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$trainer_id = $_GET['id'];

// Fetch trainer details
$sql = "SELECT * FROM Trainers WHERE trainer_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$trainer_id]);
$trainer = $stmt->fetch();

if (!$trainer) {
    echo "Trainer not found.";
    exit;
}

// Update trainer details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $certification = $_POST['certification'];

    $sql = "UPDATE Trainers SET first_name = ?, last_name = ?, certification = ? WHERE trainer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $certification, $trainer_id]);

    echo "Trainer updated successfully! <a href='trainer-management.php'>Back to Trainer Management</a>";
}
?>

<h2>Edit Trainer</h2>

<!-- Form to edit trainer details -->
<form method="POST">
    <label>First Name: <input type="text" name="first_name" value="<?php echo htmlspecialchars($trainer['first_name']); ?>" required></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?php echo htmlspecialchars($trainer['last_name']); ?>" required></label><br>
    <label>Certification: <input type="text" name="certification" value="<?php echo htmlspecialchars($trainer['certification']); ?>" required></label><br>
    <button type="submit">Update Trainer</button>
</form>
