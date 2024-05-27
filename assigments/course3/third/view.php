<?php
session_start();

// If user is not logged in, deny access
if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

// Fetch all automobiles from the database
require_once "pdo.php";

$stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic</title>
</head>
<body>
<div class="container">
    <h1>Automobiles Database</h1>

    <table border="1">
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Mileage</th>
            <th>Action</th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo htmlentities($row['make']); ?></td>
                <td><?php echo htmlentities($row['model']); ?></td>
                <td><?php echo htmlentities($row['year']); ?></td>
                <td><?php echo htmlentities($row['mileage']); ?></td>
                <td><a href="edit.php?autos_id=<?php echo $row['autos_id']; ?>">Edit</a> | <a href="delete.php?autos_id=<?php echo $row['autos_id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="add.php">Add New Entry</a> | <a href="logout.php">Logout</a></p>
</div>
</body>
</html>
