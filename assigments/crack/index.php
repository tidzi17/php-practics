<!DOCTYPE html>
<head><title>Tijana MD5 Cracker</title></head>
<body>
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash
of a four-digit numeric code and 
attempts to hash all four-digit combinations
to determine the original code.</p>
<pre>
Debug Output:
<?php
$goodtext = "Not found";
// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) {
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];

    $show = 15;

    // Loop through all 4-digit combinations
    for($i=0; $i <= 9999; $i++ ) {
        // Format the number to be exactly 4 digits
        $try = str_pad($i, 4, '0', STR_PAD_LEFT);

        // Run the hash and then check to see if we match
        $check = hash('md5', $try);
        if ( $check == $md5 ) {
            $goodtext = $try;
            break;   // Exit the loop once a match is found
        }

        // Debug output until $show hits 0
        if ( $show > 0 ) {
            print "$check $try\n";
            $show = $show - 1;
        }
    }

    // Compute elapsed time
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";
}
?>
</pre>
<!-- Use the very short syntax and call htmlentities() -->
<p>Original Text: <?= htmlentities($goodtext); ?></p>
<form>
<input type="text" name="md5" size="60" />
<input type="submit" value="Crack MD5"/>
</form>
<ul>
<li><a href="index.php">Reset</a></li>
<li><a href="md5.php">MD5 Encoder</a></li>
<li><a href="makecode.php">MD5 Code Maker</a></li>
</ul>
</body>
</html>


