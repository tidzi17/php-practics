<?php
require_once "pdo.php";
// GOOD EXAMPLE

if ( isset($_POST['email']) && isset($_POST['password'])) {
    echo("<p>Handling POST data...</p></br>");

    $sql = "SELECT name FROM users 
    WHERE email = :em
    AND password = :pw";

    echo "<p>$sql</p>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'],
        ':pw' => $_POST['password']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    var_dump($row);
    echo "--></br>";
    if ( $row === FALSE ) {
        echo "<h1>Login incorrect.</h1>";
    } else {
        echo "<p>Login success</p>";
    }
}

?>


<p>Please Log In</p>
<form method="post">
<p>
    Email:
    <input type="text" size="40" name="email"/>
</p>
<p>
    Password:
    <input type="text" size="40" name="password"/>
</p>
<p><input type="submit" value="Login" />
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a>
</p>
</form>