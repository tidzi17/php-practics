<?php
echo "<pre></br>"; // This line adds some formatting to the output, making it easier to read.
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'fred', 'zap'); // This line creates a new PDO instance to connect to the MySQL database. 'fred' is the username and 'zap' is the password.
$stmt = $pdo->query("SELECT * FROM users"); // This line runs the SQL query "SELECT * FROM users" on the database. The `query` method returns a PDOStatement object, which is stored in $stmt.
while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) { // This line begins a loop that fetches each row of the result set as an associative array.
    print_r($row); // This line prints the fetched row.
}
echo "</pre></br>"; // This line closes the formatting tags.
?>