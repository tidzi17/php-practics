<?php
session_start();
require_once "pdo.php";

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing profile_id";
    header("Location: index.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :pid");
$stmt->execute(array(":pid" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = "Invalid profile_id";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - View Profile a1a7f7fd</title>
</head>
<body>
<div class="container">
    <h1>Profile Information</h1>

    <!-- Display Profile Details -->
    <p>First Name: <?= htmlentities($row['first_name']) ?></p>
    <p>Last Name: <?= htmlentities($row['last_name']) ?></p>
    <p>Email: <?= htmlentities($row['email']) ?></p>
    <p>Headline: <?= htmlentities($row['headline']) ?></p>
    <p>Summary:<br><?= htmlentities($row['summary']) ?></p>

    <!-- Back to Index Link -->
    <p><a href="index.php">Back</a></p>
</div>
</body>
</html>
