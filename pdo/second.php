<?php

require_once 'pdo.php';
$stmt = $pdo->query("SELECT name, email, password FROM users");
echo '<table border="1">'.'</br>';
while ($row = $stmt-> fetch(PDO::FETCH_ASSOC)){
    echo "<tr><td>";
    echo isset($row['name']) ? $row['name'] : 'N/A';
    echo "</td><td>";
    echo isset($row['email']) ? $row['email'] : 'N/A';
    echo "</td><td>";
    echo isset($row['password']) ? $row['password'] : 'N/A';
    echo "</td></tr></br>";
}
echo '</table></br>';
?>