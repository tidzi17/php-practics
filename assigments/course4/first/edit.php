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
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
    // Validate incoming data
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['headline']) || empty($_POST['summary'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?profile_id=" . urlencode($_GET['profile_id']));
        return;
    } elseif (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = "Email address must contain @";
        header("Location: edit.php?profile_id=" . urlencode($_GET['profile_id']));
        return;
    }

    // Update data in the database
    $sql = "UPDATE Profile SET first_name = :fn, last_name = :ln, email = :em, headline = :he, summary = :su WHERE profile_id = :pid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'],
        ':pid' => $_GET['profile_id']
    ]);

    // Set success message and redirect to index.php
    $_SESSION['success'] = "Profile updated";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
<div class="container">
    <h1>Edit Profile</h1>

    <!-- Display Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Edit Profile Form -->
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlentities($row['first_name']) ?>"><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlentities($row['last_name']) ?>"><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= htmlentities($row['email']) ?>"><br><br>

        <label for="headline">Headline:</label>
        <input type="text" id="headline" name="headline" value="<?= htmlentities($row['headline']) ?>"><br><br>

        <label for="summary">Summary:</label><br>
        <textarea id="summary" name="summary" rows="8" cols="80"><?= htmlentities($row['summary']) ?></textarea><br><br>

        <input type="submit" value="Save">
        <a href="index.php">Cancel</a>
    </form>

</div>
</body>
</html>


