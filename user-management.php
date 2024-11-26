<?php
include 'config.php';
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Fetch all users from the database
$sql = "SELECT * FROM Users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>

    <h1>Manage Users</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['first_name'] . " " . $user['last_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo ucfirst($user['role']); ?></td>
            <td>
                <a href="edit-user.php?id=<?php echo $user['user_id']; ?>">Edit</a> | 
                <a href="delete-user.php?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
