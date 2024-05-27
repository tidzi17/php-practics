<?php
session_start();
require_once "pdo.php";

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    die("ACCESS DENIED");
}

// Check if profile_id is provided in the GET request
if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing profile_id";
    header("Location: index.php");
    return;
}

// Fetch the profile data
$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :pid AND user_id = :uid");
$stmt->execute([
    ':pid' => $_GET['profile_id'],
    ':uid' => $_SESSION['user_id']
]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = "Could not load profile";
    header("Location: index.php");
    return;
}

// Handle form submission
if (isset($_POST['delete']) && isset($_POST['profile_id'])) {
    $sql = "DELETE FROM Profile WHERE profile_id = :pid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':pid' => $_POST['profile_id']]);

    $_SESSION['success'] = "Profile deleted";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Profile</title>
</head>
<body>
<div class="container">
    <h1>Delete Profile</h1>

    <!-- Display Confirmation Message -->
    <p>Are you sure you want to delete this profile?</p>

    <!-- Delete Profile Form -->
    <form method="post">
        <input type="hidden" name="profile_id" value="<?= $row['profile_id'] ?>">
        <input type="submit" name="delete" value="Delete">
        <a href="index.php">Cancel</a>
    </form>

</div>
</body>
</html>

