<?php

session_start();
if ( ! isset($_SESSION['pizza']) ){
    echo("<p>Session is empty</p>");
    $_SESSION['pizza'] = 0;
} else if ( $_SESSION['pizza'] < 3 ) {
    $_SESSION['pizza'] = $_SESSION['pizza'] + 1;
    echo("<p>Adding one...</p>");
} else {
    session_destroy();
    session_start();
    echo("<p>Session Reastarted</p></br>");
}

?>

<p><a href="sessfun.php">Click me!</a></p>
<p>Our Session ID id:<?php echo(session_id());?></p>
<pre>
    <?php print_r($_SESSION);?>
</pre>