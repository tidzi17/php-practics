<?php
session_start();

require_once "pdo.php"; 


if (!isset($_SESSION['user_id'])) {
    die('ACCESS DENIED');
}

function loadProfile($pdo, $profile_id) {
    $stmt = $pdo->prepare('SELECT * FROM Profile WHERE profile_id = :pid');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function loadPos($pdo, $profile_id) {
    $stmt = $pdo->prepare('SELECT * FROM Position WHERE profile_id = :pid ORDER BY rank');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function loadEdu($pdo, $profile_id) {
    $stmt = $pdo->prepare('SELECT * FROM Education WHERE profile_id = :pid ORDER BY rank');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validateProfile() {
    return true; 
}

function flashMessages() {
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . htmlentities($_SESSION['error']) . "</p>\n";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green">' . htmlentities($_SESSION['success']) . "</p>\n";
        unset($_SESSION['success']);
    }
}

if (isset($_POST['save'])) {
    $msg = validateProfile();
    if (is_string($msg)) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_POST['profile_id']);
        return;
    }

    $sql = "UPDATE Profile SET user_id = :uid, first_name = :fn, last_name = :ln, email = :em, headline = :he, summary = :su WHERE profile_id = :pid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'],
        ':pid' => $_POST['profile_id']
    ));

    $stmt = $pdo->prepare('DELETE FROM Position WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $_POST['profile_id']));

    $rank = 1;
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['year'.$i])) continue;
        if (!isset($_POST['desc'.$i])) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];
        $stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES (:pid, :rank, :year, :desc)');
        $stmt->execute(array(
            ':pid' => $_POST['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':desc' => $desc
        ));
        $rank++;
    }

    $stmt = $pdo->prepare('DELETE FROM Education WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $_POST['profile_id']));

    $rank = 1;
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['edu_year'.$i])) continue;
        if (!isset($_POST['edu_school'.$i])) continue;

        $year = $_POST['edu_year'.$i];
        $school = $_POST['edu_school'.$i];
        $stmt = $pdo->prepare('INSERT INTO Education (profile_id, rank, year, school) VALUES (:pid, :rank, :year, :school)');
        $stmt->execute(array(
            ':pid' => $_POST['profile_id'],
            ':rank' => $rank,
            ':year' => $year,
            ':school' => $school
        ));
        $rank++;
    }

    $_SESSION['success'] = 'Profile updated';
    header('Location: index.php');
    return;
}

if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = 'Missing profile_id';
    header('Location: index.php');
    return;
}

$profile = loadProfile($pdo, $_GET['profile_id']);
$positions = loadPos($pdo, $_GET['profile_id']);
$educations = loadEdu($pdo, $_GET['profile_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>
<div class="container">
    <h1>Edit Profile</h1>
    <?php
    flashMessages();
    ?>
    <form method="post">
        <input type="hidden" name="profile_id" value="<?= $_GET['profile_id'] ?>">
        <p>First Name:
            <input type="text" name="first_name" size="60" value="<?= htmlentities($profile['first_name']) ?>"></p>
        <p>Last Name:
            <input type="text" name="last_name" size="60" value="<?= htmlentities($profile['last_name']) ?>"></p>
        <p>Email:
            <input type="text" name="email" size="30" value="<?= htmlentities($profile['email']) ?>"></p>
        <p>Headline:<br>
            <input type="text" name="headline" size="80" value="<?= htmlentities($profile['headline']) ?>"></p>
        <p>Summary:<br>
            <textarea name="summary" rows="8" cols="80"><?= htmlentities($profile['summary']) ?></textarea></p>

        <p>Position: <input type="submit" id="addPos" value="+">
        <div id="position_fields">
            <?php
            $rank = 1;
            foreach ($positions as $position) {
                echo '<div id="position'.$rank.'">';
                echo '<p>Year: <input type="text" name="year'.$rank.'" value="'.htmlentities($position['year']).'">';
                echo '<input type="button" value="-" onclick="$(\'#position'.$rank.'\').remove();return false;"><br>';
                echo '<textarea name="desc'.$rank.'" rows="8" cols="80">'.htmlentities($position['description']).'</textarea>';
                echo '</div>';
                $rank++;
            }
            ?>
        </div></p>

        <p>Education: <input type="submit" id="addEdu" value="+">
        <div id="education_fields">
            <?php
            $rank = 1;
            foreach ($educations as $education) {
                echo '<div id="education'.$rank.'">';
                echo '<p>Year: <input type="text" name="edu_year'.$rank.'" value="'.htmlentities($education['year']).'">';
                echo '<input type="button" value="-" onclick="$(\'#education'.$rank.'\').remove();return false;"><br>';
                echo '<p>School: <input type="text" size="80" name="edu_school'.$rank.'" class="school" value="'.htmlentities($education['school']).'"></p>';
                echo '</div>';
                $rank++;
            }
            ?>
        </div></p>

        <p><input type="submit" name="save" value="Save"/>
            <input type="submit" name="cancel" value="Cancel"/></p>
    </form>
</div>


<script>
    $(document).ready(function() {
        var countPos = <?= count($positions) ?>;
        var countEdu = <?= count($educations) ?>;
        
        $('#addPos').click(function(event) {
            event.preventDefault();
            if (countPos >= 9) {
                alert("Maximum of nine position entries exceeded");
                return;
            }
            countPos++;
            $('#position_fields').append(
                '<div id="position'+countPos+'"> \
                    <p>Year: <input type="text" name="year'+countPos+'" value="" /> \
                    <input type="button" value="-" \
                        onclick="$(\'#position'+countPos+'\').remove();return false;"><br> \
                    <textarea name="desc'+countPos+'" rows="8" cols="80"></textarea> \
                </div>');
        });

        $('#addEdu').click(function(event) {
            event.preventDefault();
            if (countEdu >= 9) {
                alert("Maximum of nine education entries exceeded");
                return;
            }
            countEdu++;
            $('#education_fields').append(
                '<div id="education'+countEdu+'"> \
                    <p>Year: <input type="text" name="edu_year'+countEdu+'" value="" /> \
                    <input type="button" value="-" \
                        onclick="$(\'#education'+countEdu+'\').remove();return false;"><br> \
                    <p>School: <input type="text" size="80" name="edu_school'+countEdu+'" class="school" value="" /></p> \
                </div>');
        });
    });
</script>
</body>
</html>






