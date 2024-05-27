<?php

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

function validateProfile() {
    return true;
}

function validateEducation() {
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['edu_year'.$i])) continue;
        if (!isset($_POST['edu_school'.$i])) continue;

        $year = $_POST['edu_year'.$i];
        $school = $_POST['edu_school'.$i];

        if (strlen($year) == 0 || strlen($school) == 0) {
            return "All fields are required";
        }

        if (!is_numeric($year)) {
            return "Year must be numeric";
        }
    }
    return true;
}

function getInstitutionId($pdo, $name) {
    $stmt = $pdo->prepare('SELECT institution_id FROM Institution WHERE name = :name');
    $stmt->execute(array(':name' => $name));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row !== false) {
        return $row['institution_id'];
    }

    
    $stmt = $pdo->prepare('INSERT INTO Institution (name) VALUES (:name)');
    $stmt->execute(array(':name' => $name));
    return $pdo->lastInsertId();
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



?>

