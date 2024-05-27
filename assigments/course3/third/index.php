<?php
session_start();

require_once "pdo.php";

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    return;
}

// Query to fetch automobiles if logged in
$rows = [];
if (isset($_SESSION['name'])) {
    $stmt = $pdo->query("SELECT * FROM autos");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic</title>
</head>
<body>
<div class="container">
    <h1>Welcome to the Automobiles Database</h1>

    <!-- Display Logout Link if Logged In -->
    <?php if (isset($_SESSION['name'])): ?>
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    <?php endif; ?>

    <!-- Display Success Message if Any -->
    <?php
    if (isset($_SESSION['success'])) {
        echo '<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n";
        unset($_SESSION['success']);
    }
    ?>

    <!-- Display Automobiles Table if Logged In and Rows Found -->
    <?php if (isset($_SESSION['name']) && $rows && count($rows) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Mileage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= htmlentities($row['make']) ?></td>
                        <td><?= htmlentities($row['model']) ?></td>
                        <td><?= htmlentities($row['year']) ?></td>
                        <td><?= htmlentities($row['mileage']) ?></td>
                        <td>
                            <a href="edit.php?autos_id=<?= $row['autos_id'] ?>">Edit</a> |
                            <a href="delete.php?autos_id=<?= $row['autos_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($_SESSION['name']) && $rows && count($rows) == 0): ?>
        <p>No rows found</p>
    <?php elseif (!isset($_SESSION['name'])): ?>
        <a href="login.php">Please log in</a>
    <?php endif; ?>

    <!-- Add New Entry Link if Logged In -->
    <?php if (isset($_SESSION['name'])): ?>
        <p><a href="add.php">Add New Entry</a></p>
    <?php endif; ?>

</div>
</body>
</html>






