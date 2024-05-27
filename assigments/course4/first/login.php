<?php
session_start();
require_once "pdo.php";

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $salt = 'XyZzy12*_';
    $check = hash('md5', $salt . $_POST['pass']);

    $stmt = $pdo->prepare('SELECT user_id, name FROM users
        WHERE email = :em AND password = :pw');

    $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = "Incorrect password";
        header("Location: login.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tijana Djudjic - Login a1a7f7fd</title>
    <script>
        function doValidate() {
            console.log('Validating...');
            try {
                em = document.getElementById('id_1723').value;
                console.log("Validating email="+em);
                if (em == null || em == "") {
                    alert("Both fields must be filled out");
                    return false;
                }
                return true;
            } catch(e) {
                return false;
            }
            return false;
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="POST">
        <label for="email">Email</label>
        <input type="text" name="email" id="id_1723"><br/>
        <label for="pass">Password</label>
        <input type="password" name="pass"><br/>
        <input type="submit" onclick="return doValidate();" value="Log In">
        <a href="index.php">Cancel</a>
    </form>
</div>
</body>
</html>
