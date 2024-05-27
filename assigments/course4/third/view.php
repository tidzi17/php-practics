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


$stmt = $pdo->prepare("SELECT * FROM Position WHERE profile_id = :pid ORDER BY rank");
$stmt->execute(array(":pid" => $_GET['profile_id']));
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM Education WHERE profile_id = :pid ORDER BY rank");
$stmt->execute(array(":pid" => $_GET['profile_id']));
$educations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - View Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>
<div class="container">
    <h1>Profile Information</h1>

    <p>First Name: <?= htmlentities($row['first_name']) ?></p>
    <p>Last Name: <?= htmlentities($row['last_name']) ?></p>
    <p>Email: <?= htmlentities($row['email']) ?></p>
    <p>Headline: <?= htmlentities($row['headline']) ?></p>
    <p>Summary:<br><?= htmlentities($row['summary']) ?></p>

    <?php
    if (count($positions) > 0) {
        echo '<h3>Positions</h3><ul>';
        foreach ($positions as $position) {
            echo '<li><p>Year: ' . htmlentities($position['year']) . '</p>';
            echo '<p>Description: ' . htmlentities($position['description']) . '</p></li>';
        }
        echo '</ul>';
    }
    ?>

    <?php
    if (count($educations) > 0) {
        echo '<h3>Education</h3><ul>';
        foreach ($educations as $education) {
            echo '<li><p>Year: ' . htmlentities($education['year']) . '</p>';
            echo '<p>School: ' . htmlentities($education['school']) . '</p></li>';
        }
        echo '</ul>';
    }
    ?>

 
    <p><a href="index.php">Back</a></p>
</div>
</body>
</html>

