<?php // Do not put any HTML above this line

error_reporting(E_ALL);
ini_set('display_errors', '1');

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if (isset($_POST['who']) && isset($_POST['pass'])) {
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
        $failure = "Email and password are required";
    } elseif (!strpos($_POST['who'], '@')) {
        $failure = "Email must have an at-sign (@)";
    } else {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check == $stored_hash) {
            // Redirect the browser to autos.php
            session_start();
            $_SESSION['name'] = $_POST['who'];
            header("Location: autos.php");
            error_log("Login success ".$_POST['who']);
            return;
        } else {
            $failure = "Incorrect password";
            error_log("Login fail ".$_POST['who']." $check");
        }
    }
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic </title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if ($failure !== false) {
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    ?>
    <form method="post">
        <label for="nam">Email</label>
        <input type="text" name="who" id="nam"><br/>
        <label for="id_1723">Password</label>
        <input type="password" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is php123 -->
    </p>
</div>
</body>
</html>

