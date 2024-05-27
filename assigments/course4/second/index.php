<?php
session_start();
require_once "pdo.php";

// Query to fetch profiles
$stmt = $pdo->query("SELECT profile_id, first_name, last_name FROM Profile");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - Resume Database</title>
</head>
<body>
<div class="container">
    <h1>Welcome to the Resume Database</h1>

    <!-- Display Logout Link if Logged In -->
    <?php if (isset($_SESSION['name'])): ?>
        <form method="post" action="logout.php">
            <p>Welcome <?= htmlentities($_SESSION['name']) ?>! <input type="submit" value="Logout"></p>
        </form>
    <?php else: ?>
        <p><a href="login.php">Please log in</a></p>
    <?php endif; ?>

     <!-- Display Success Message if Any -->
     <?php
    if (isset($_SESSION['success'])) {
        echo '<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n";
        unset($_SESSION['success']);
    }
    ?>

    <!-- Display Profiles Table -->
    <?php if ($rows && count($rows) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlentities($row['first_name'] . ' ' . $row['last_name']) ?></td>
                        <td>
                            <a href="view.php?profile_id=<?= $row['profile_id'] ?>">View</a> |
                            <a href="edit.php?profile_id=<?= $row['profile_id'] ?>">Edit</a> |
                            <a href="delete.php?profile_id=<?= $row['profile_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No profiles found</p>
    <?php endif; ?>

    <!-- Add New Entry Link if Logged In -->
    <?php if (isset($_SESSION['name'])): ?>
        <p><a href="add.php">Add New Entry</a></p>
    <?php endif; ?>

</div>
</body>
</html>
