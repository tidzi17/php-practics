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
    // Add your validation logic here
    return true; // Return true if validated, or an error message if not
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
