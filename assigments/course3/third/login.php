<?php
session_start();

require_once "pdo.php";

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Password is php123

if (isset($_POST['email']) && isset($_POST['pass'])) {
    unset($_SESSION['name']);
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
        return;
    } elseif (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ($check == $stored_hash) {
            $_SESSION['name'] = $_POST['email'];
            header("Location: index.php");
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
    <title>Tijana Djudjic</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>

    <!-- Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Login Form -->
    <form method="post">
        <p>Email:
            <input type="text" name="email">
        </p>
        <p>Password:
            <input type="password" name="pass">
        </p>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>

    <p>
        For a password hint, view source and find an account and password hint in the HTML comments.
        <!-- Hint: The account is umsi@umich.edu. The password is the three character name of the programming language used in this class (all lower case) followed by 123. -->
    </p>

</div>
</body>
</html>

