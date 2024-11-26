<?php
include 'config.php';
session_start();

// Check if already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect logged-in users to their respective page
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin_dashboard.php"); // Admin goes to the admin dashboard
    } else {
        header("Location: index.php"); // Regular user goes to the homepage
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the query to check the user credentials
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Validate credentials and role
    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user info in session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role']; // Store the user's role

        // Redirect based on role
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        } else {
            header("Location: index.php"); // Redirect to user homepage
        }
        exit;
    } else {
        // Error message for incorrect credentials
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 10px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Login to Fitness Tracker</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>

</body>
</html>
