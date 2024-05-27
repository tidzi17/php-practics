<?php
require_once "pdo.php";

session_start();

if (!isset($_SESSION['name'])) {
    die("Name parameter missing");
}

// Handle POST data if form is submitted
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session data
    header('Location: index.php');
    return;
}

$failure = false;
$success = false;

// Insert data into the database if "Add" button is pressed
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1) {
        $failure = "Make is required";
    } elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $failure = "Mileage and year must be numeric";
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage']
        ));
        $success = "Record inserted";
    }
}

// Fetch all automobiles from database
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic </title>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo htmlentities($_SESSION['name']); ?></h1>

    <?php
    // Error or success message display
    if ($failure !== false) {
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    if ($success !== false) {
        echo('<p style="color: green;">' . htmlentities($success) . "</p>\n");
    }
    ?>

    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>
        <input type="submit" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>

    <h2>Automobiles</h2>
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
</div>
</body>
</html>

