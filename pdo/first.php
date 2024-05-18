<?php
echo "<pre></br>";

$dns = 'mysql:host=localhost;dbname=misc';
$username = 'fred';
$password = 'zap';

$pdo = new PDO($dns, $username , $password );
$stmt = $pdo->query("SELECT * FROM users");
while ($row = $stmt-> fetch(PDO::FETCH_ASSOC)){
    print_r($row);
}

echo "</pre></br>";
?>