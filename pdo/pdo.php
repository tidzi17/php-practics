<?php
$dns = 'mysql:host=localhost;dbname=misc';
$username = 'fred';
$password = 'zap';

$pdo = new PDO($dns, $username , $password );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>