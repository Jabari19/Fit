<?php
include 'config.php'; // For database connection
session_start();

// Check if the user is an admin, if not, redirect to home page
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Initialize feedback messages
$feedback = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $age = (int)$_POST['age'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // SQL query to insert new user into database
    $sql = "INSERT INTO Users (first_name, last_name, email, age, password, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        // Execute the prepared statement with user data
        $stmt->execute([$first_name, $last_name, $email, $age, $password, $role]);
        $feedback = "User created successfully!";
    } catch (Exception $e) {
        $feedback = "Error creating user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create New User</h1>
        
        <!-- Display feedback message -->
        <?php if ($feedback): ?>
            <p class="feedback"><?php echo $feedback; ?></p>
        <?php endif; ?>
        
        <!-- User creation form -->
        <form method="POST">
            <label>First Name: <input type="text" name="first_name" required></label><br>
            <label>Last Name: <input type="text" name="last_name" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Age: <input type="number" name="age" required min="1"></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <label>Role: 
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </label><br>
            <button type="submit">Create User</button>
        </form>
    </div>
</body>
</html>
