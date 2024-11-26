<?php
include 'config.php';
session_start();

// Ensure the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Check if the user ID is provided
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    try {
        // Delete the user from the database
        $sql = "DELETE FROM Users WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        echo "User deleted successfully.";
        // Optionally, redirect back to the user management page
        header("Location: admin_users.php");
        exit;
    } catch (PDOException $e) {
        echo "Error deleting user: " . $e->getMessage();
        exit;
    }
} else {
    echo "No user ID specified.";
}
?>
