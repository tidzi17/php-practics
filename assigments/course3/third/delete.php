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

// Handle POST data if form is submitted
if (isset($_POST['delete']) && isset($_POST['autos_id'])) {
    $stmt = $pdo->prepare('DELETE FROM autos WHERE autos_id = :autos_id');
    $stmt->execute(array(':autos_id' => $_POST['autos_id']));
    $_SESSION['success'] = "Record deleted";
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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Automobile</title>
</head>
<body>
<div class="container">
    <h1>Delete Automobile</h1>

    <!-- Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Display Confirmation Form -->
    <form method="post">
        <p>Make: <?= htmlentities($row['make']) ?></p>
        <p>Model: <?= htmlentities($row['model']) ?></p>
        <input type="hidden" name="autos_id" value="<?= $row['autos_id'] ?>">
        <input type="submit" name="delete" value="Delete">
        <a href="index.php">Cancel</a>
    </form>

</div>
</body>
</html>

