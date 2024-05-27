<?php
session_start();
require_once "pdo.php";

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    $_SESSION['error'] = "Not logged in";
    header('Location: login.php');
    return;
}

// Handle success message
if (isset($_SESSION['success'])) {
    echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
    unset($_SESSION['success']);
}

// Fetch all automobiles from database
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - Autos Database</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo htmlentities($_SESSION['name']); ?></h1>

    <ul>
        <?php
        foreach ($rows as $row) {
            echo "<li>";
            echo htmlentities($row['year']) . " ";
            echo htmlentities($row['make']) . " / ";
            echo htmlentities($row['mileage']);
            echo "</li>";
        }
        ?>
    </ul>

    <p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
</div>
</body>
</html>

