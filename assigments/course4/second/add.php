<?php
session_start();

require_once "pdo.php";

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    die("ACCESS DENIED");
}

// Handle form submission
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) &&
    isset($_POST['headline']) && isset($_POST['summary'])) {

    // Validate incoming data
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) ||
        empty($_POST['headline']) || empty($_POST['summary'])) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    }

    // Validate positions
    $msg = validatePos();
    if (is_string($msg)) {
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    // Data is valid - time to insert
    $stmt = $pdo->prepare('INSERT INTO Profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES (:uid, :fn, :ln, :em, :he, :su)');

    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary']
    ));

    $profile_id = $pdo->lastInsertId();

    // Insert position entries
    $rank = 1;
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['year' . $i])) continue;
        if (!isset($_POST['desc' . $i])) continue;

        $year = $_POST['year' . $i];
        $desc = $_POST['desc' . $i];
        $stmt = $pdo->prepare('INSERT INTO Position
            (profile_id, rank, year, description)
            VALUES (:pid, :rank, :year, :desc)');

        $stmt->execute(array(
            ':pid' => $profile_id,
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc
        ));

        $rank++;
    }

    $_SESSION['success'] = "Profile added";
    header("Location: index.php");
    return;
}
function validatePos() {
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['year'.$i])) continue;
        if (!isset($_POST['desc'.$i])) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];

        if (strlen($year) == 0 || strlen($desc) == 0) {
            return "All fields are required";
        }

        if (!is_numeric($year)) {
            return "Position year must be numeric";
        }
    }
    return true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>
<div class="container">
    <h1>Adding Profile for <?php echo htmlentities($_SESSION['name']); ?></h1>

    <!-- Display Error Message -->
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Add New Profile Form -->
    <form method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name"><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>

        <label for="headline">Headline:</label>
        <input type="text" id="headline" name="headline"><br><br>

        <label for="summary">Summary:</label><br>
        <textarea id="summary" name="summary" rows="8" cols="80"></textarea><br><br>

        <div id="position_fields">
            <label>Position:</label><br>
            <button type="button" id="addPos">+</button><br><br>
        </div>

        <input type="submit" value="Add">
        <input type="button" value="Cancel" onclick="location.href='index.php'; return false;">
    </form>

    <script>
        countPos = 0;

        $(document).ready(function () {
            window.console && console.log('Document ready called');
            $('#addPos').click(function (event) {
                event.preventDefault();
                if (countPos >= 9) {
                    alert("Maximum of nine position entries exceeded");
                    return;
                }
                countPos++;
                window.console && console.log("Adding position " + countPos);
                $('#position_fields').append(
                    '<div id="position' + countPos + '"> \
                    <p>Year: <input type="text" name="year' + countPos + '" value=""> \
                    <input type="button" value="-" onclick="$(\'#position' + countPos + '\').remove();return false;"></p> \
                    <textarea name="desc' + countPos + '" rows="8" cols="80"></textarea> \
                    </div>');
            });
        });
    </script>
</div>
</body>
</html>

