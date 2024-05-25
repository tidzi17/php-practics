<?php
require_once "pdo.php";

if ( isset( $_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $sql = "INSERT INTO users (name, email, password)
    VALUES (:name, :email, :password)";
    echo("<pre></br>".$sql."</br></pre>");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
}


if ( isset( $_POST['delete']) && isset($_POST['user_id'])){
    $sql = "DELETE FROM users WHERE user_id = :zip";
    echo "<pre></br>$sql</br></pre>";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
}

?>

<html>
    <head></head> <body> <table border='1'>
    <?php
    $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo "<tr><td>";
        echo($row['name']);
        echo("</td><td>");
        echo($row['email']);
        echo("</td><td>");
        echo($row['password']);
        echo("</td><td>");
        echo('<form method="post"><input type="hidden" ');
        echo('name="user_id" value="'.$row['user_id'].'">'."</br>");
        echo('<input type="submit" value="Del" name="delete">');
        echo("</br></form></br>");
        echo("</td></tr></br>");
    }
    ?>
    </table>


    <p>Add A New User</p>
    <form method="post">
            <p>Name:
                <input type="text" name="name" size="40" />
            </p>

            <p>Email:
                <input type="text" name="email" size="40" />
            </p>

            <p>Password:
                <input type="password" name="password" size="40" />
            </p>

            <p>
                <input type="submit" value="Add New" />
            </p>
        </form>
</body>
</html>