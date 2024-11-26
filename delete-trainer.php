<?php
include 'config.php'; 
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$trainer_id = $_GET['id'];

// Delete the trainer from the database
$sql = "DELETE FROM Trainers WHERE trainer_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$trainer_id]);

echo "Trainer deleted successfully! <a href='trainer-management.php'>Back to Trainer Management</a>";
?>
