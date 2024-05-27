<?php
session_start();
require_once "pdo.php";

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    $_SESSION['error'] = "Not logged in";
    header('Location: login.php');
    return;
}

// Handle POST data if form is submitted
if (isset($_POST['cancel'])) {
    header('Location: view.php');
    return;
}

$failure = false;

// Insert data into the database if "Add" button is pressed
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) < 1) {
        $_SESSION['error'] = "Make is required";
        header("Location: add.php");
        return;
    } elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Mileage and year must be numeric";
        header("Location: add.php");
        return;
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage']
        ));
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - Autos Database</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Add New Automobile</h1>

    <?php
    // Error message display
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
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
        <input type="submit" name="cancel" value="Cancel">
    </form>

    <p><a href="view.php">Cancel</a></p>
</div>
</body>
</html>

