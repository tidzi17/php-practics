<?php
echo "<pre></br>";
require_once "pdo.php";

$stmt = $pdo->query("SELECT * FROM users");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
}
echo "</pre></br>";
?>