<?php
session_start();

if (isset($_SESSION['name'])) {
    header('Location: view.php');
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

$failure = false;

// Check to see if we have some POST data, if we do process it
if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
        return;
    } elseif (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check == $stored_hash) {
            // Redirect the browser to view.php
            $_SESSION['name'] = $_POST['email'];
            header("Location: view.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            header("Location: login.php");
            return;
        }
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
    <h1>Please Log In</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br/>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass"><br/>
        <input type="submit" value="Log In">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is php123 -->
    </p>
</div>
</body>
</html>


