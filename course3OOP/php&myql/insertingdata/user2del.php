<?php
require_once "../pdo/pdo.php";

if ( isset($_POST['user_id'])) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    echo "<pre></br>$sql</br></pre></br>";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip'=> $_POST['user_id']));
}
?>
<p>Delete user</p>
<form method="post">
    <p>ID to Delete:</p>
    <input type="text" name="user_id"/>
    <input type="submit" value="Delete" />

</form>