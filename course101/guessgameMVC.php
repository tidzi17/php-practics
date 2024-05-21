<?php
$oldguess = '';
$message = false;

if ( isset($_POST['guess'])){
    //Trick for integer / numeric parameters
    $oldguess = $_POST['guess'] + 0;
    if ( $oldguess == 42 ) {
        $message = "Great job!";
    } else if ( $oldguess < 42) {
        $message = "Too low";
    } else {
        $message = "Too high...";
    }
}
?>

<html>
    <head>
        <title>A Guessing Game</title>
    </head>
    <body>
        <p>Guessing game...</p>
    </body>

    <?php
    if ( $message !== false ) {
        echo("<p>$message</p></br>");
    }
    ?>

    <form method="post">
        <label for="guess">Input Guess</label>
        <input type="text" name="guess" id="guess" size="40"
        value="<?=htmlentities($oldguess)?>" />
        <input type="submit"/>
    </form>
</html>