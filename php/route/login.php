<?php
session_start();
if ( isset($_POST['account']) && isset($_POST['password']) ) {
    unset($_SESSION['account']); //Logout current user
    if ($_POST['password'] == '1234' ) {
        $_SESSION['account'] = $_POST['account'];
        $_SESSION['success'] = "Logged in.";
        header( 'Location: app.php ');
        return;
    } else {
        $_SESSION["error"] = "Incorect password.";
        header( 'Location: login.php ');
        return;
    }
}
?>

<html>
    <head></head>
    <body style="font-family: sans-serif;"> 
    <h1>Please Log In</h1>

    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color:red">'.$_SESSION['error']."</p></br>");
        unset($_SESSION['error']);
    }
    if ( isset($_SESSION['success'])) {
        echo('<p style="color:green">'.$_SESSION['success']."</p></br>");
        unset($_SESSION['success']);
    }
    ?>
    <form method="post">
        <p>Account: <input type="text" name="account" value=""></p>
        <p>Password: <input type="text" name="password" value=""></p>
        <!-- password is 1234 -->
    <p><input type="submit"  value="Log In">
    <a href="app.php">Cancel</a>
</p>
    </form>

</body>
</html>