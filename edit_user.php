<?php
include 'config.php'; 
session_start();

// Ensure that the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Fetch the user data to prefill the form
$id = $_GET['id']; // Get the user ID from the URL
$sql = "SELECT * FROM Users WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$user = $stmt->fetch();

// If no user is found, redirect to a user list or error page
if (!$user) {
    header("Location: user_list.php"); // Or another appropriate page
    exit;
}

// Initialize feedback message
$feedback = "";

// Handle form submission for updating the user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $age = (int)$_POST['age']; // Ensuring that age is an integer

    // Update user details in the database
    $sql = "UPDATE Users SET first_name = ?, last_name = ?, email = ?, age = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$first_name, $last_name, $email, $age, $id]);
        $feedback = "User updated successfully!";
    } catch (Exception $e) {
        $feedback = "Error updating user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your styles -->
</head>
<body>
    <div class="container">
        <h1>Update User Information</h1>

        <!-- Display feedback message if any -->
        <?php if ($feedback): ?>
            <p class="feedback"><?php echo $feedback; ?></p>
        <?php endif; ?>

        <!-- Form to update user details -->
        <form method="POST">
            <label>First Name: 
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </label><br>
            <label>Last Name: 
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </label><br>
            <label>Email: 
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </label><br>
            <label>Age: 
                <input type="number" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required min="1">
            </label><br>
            <button type="submit">Update User</button>
        </form>
    </div>
</body>
</html>
