<?php
include 'config.php';
session_start();

// Ensure the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

try {
    // Fetch all users from the database
    $sql = "SELECT * FROM Users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching users: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Admin Dashboard - Manage Users</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo htmlspecialchars($user['user_id']); ?>">Edit</a> | 
                    <a href="delete_user.php?id=<?php echo htmlspecialchars($user['user_id']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
