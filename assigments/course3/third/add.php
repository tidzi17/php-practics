<?php
session_start();

require_once "pdo.php";

// Redirect to login if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    return;
}

// Handle form submission
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    // Validate incoming data
    if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    } elseif (!is_numeric($_POST['year'])) {
        $_SESSION['error'] = "Year must be an integer";
        header("Location: add.php");
        return;
    } elseif (!is_numeric($_POST['mileage'])) {
        $_SESSION['error'] = "Mileage must be an integer";
        header("Location: add.php");
        return;
    }

    // Insert data into database
    $sql = "INSERT INTO autos (make, model, year, mileage) VALUES (:make, :model, :year, :mileage)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':make' => $_POST['make'],
        ':model' => $_POST['model'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage']
    ]);

    // Set success message and redirect to index.php
    $_SESSION['success'] = "Record added";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Automobile</title>
</head>
<body>
<div class="container">
    <h1>Add New Automobile</h1>

    <!-- Display Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Add New Automobile Form -->
    <form method="post">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make"><br><br>
        
        <label for="model">Model:</label>
        <input type="text" id="model" name="model"><br><br>
        
        <label for="year">Year:</label>
        <input type="text" id="year" name="year"><br><br>
        
        <label for="mileage">Mileage:</label>
        <input type="text" id="mileage" name="mileage"><br><br>
        
        <input type="submit" value="Add">
    </form>

    <!-- Back to Index Link -->
    <p><a href="index.php">Cancel</a></p>

</div>
</body>
</html>



