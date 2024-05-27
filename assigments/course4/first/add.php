<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['name'])) {
    die("ACCESS DENIED");
}

if (isset($_POST['first_name']) && isset($_POST['last_name']) &&
    isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {

    // Validate incoming data
    if (empty($_POST['first_name']) || empty($_POST['last_name']) ||
        empty($_POST['email']) || empty($_POST['headline']) || empty($_POST['summary'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    } elseif (!strpos($_POST['email'], "@")) {
        $_SESSION['error'] = "Email address must contain @";
        header("Location: add.php");
        return;
    }

    // Insert data into database
    $sql = "INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
            VALUES (:uid, :fn, :ln, :em, :he, :su)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary']
    ]);

    $_SESSION['success'] = "Profile added";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - Add New Resume a1a7f7fd</title>
</head>
<body>
<div class="container">
    <h1>Add New Resume</h1>

    <!-- Display Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Add New Resume Form -->
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name"><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>

        <label for="headline">Headline:</label>
        <input type="text" id="headline" name="headline"><br><br>

        <label for="summary">Summary:</label><br>
        <textarea id="summary" name="summary" rows="8" cols="80"></textarea><br><br>

        <input type="submit" value="Add">
        <a href="index.php">Cancel</a>
    </form>

</div>
</body>
</html>
