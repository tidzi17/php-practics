<?php
session_start();

require_once "pdo.php";

// Redirect to login if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    return;
}

// Ensure autos_id is present in query string
if (!isset($_GET['autos_id'])) {
    $_SESSION['error'] = "Missing autos_id";
    header("Location: index.php");
    return;
}

// Fetch automobile record from database
$stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :autos_id");
$stmt->execute(array(':autos_id' => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// If record does not exist, redirect to index.php
if ($row === false) {
    $_SESSION['error'] = "Invalid autos_id";
    header("Location: index.php");
    return;
}

// Handle POST data if form is submitted
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    // Validate input
    if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?autos_id=" . $_GET['autos_id']);
        return;
    } elseif (!is_numeric($_POST['year'])) {
        $_SESSION['error'] = "Year must be an integer";
        header("Location: edit.php?autos_id=" . $_GET['autos_id']);
        return;
    } elseif (!is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Mileage must be an integer";
        header("Location: edit.php?autos_id=" . $_GET['autos_id']);
        return;
    }

    // Update data in database
    $stmt = $pdo->prepare('UPDATE autos SET make = :make, model = :model, year = :year, mileage = :mileage WHERE autos_id = :autos_id');
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':model' => $_POST['model'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage'],
        ':autos_id' => $_GET['autos_id']
    ));

    $_SESSION['success'] = "Record edited";
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic</title>
</head>
<body>
<div class="container">
    <h1>Edit Automobile</h1>

    <!-- Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <form method="post">
        <p>Make:
            <input type="text" name="make" value="<?= htmlentities($row['make']) ?>">
        </p>
        <p>Model:
            <input type="text" name="model" value="<?= htmlentities($row['model']) ?>">
        </p>
        <p>Year:
            <input type="text" name="year" value="<?= htmlentities($row['year']) ?>">
        </p>
        <p>Mileage:
            <input type="text" name="mileage" value="<?= htmlentities($row['mileage']) ?>">
        </p>
        <input type="submit" value="Save">
        <a href="index.php">Cancel</a>
    </form>

</div>
</body>
</html>

