<?php
$ans = 42;
if ( $ans == 42)  {
    print "Hello world!<br>";
} else {
    print "Wrong answer<br>";
} 
?>

<?php

$x = 7;

if ($x < 2) {
    print "Small\n";
} elseif ( $x < 10 ) {
    print "Medium<br>";
} else {
    print "LARGE\n";
}

print "All done<br><br>";
?>

<?php
//WHILE LOOOP

$fuel = 10;
while ($fuel > 1) {
    print "Vroom vroom<br>";
    $fuel = $fuel -2;
}
?>


<?php
//DO WHILE LOOP

$count = 1;
do {
    echo "$count times 5 is " . $count * 5;
    echo "<br> <br>";
} while (++$count <= 5);

/* 1 times 5 is 5
2 times 5 is 10
3 times 5 is 15
4 times 5 is 20
5 times 5 is 25 */


?>

<?php
//FOR LOOP

for($count=1; $count<=6; $count++){
    echo "$count times 6 is " . $count * 6;
    echo "<br>";
    
}

/* 
1 times 6 is 6
2 times 6 is 12
3 times 6 is 18
4 times 6 is 24
5 times 6 is 30
6 times 6 is 36 */
?>

<?php
//FOR LOOP BREAK

for($count=1; $count<=600; $count++){
    if ($count == 5) break;
    echo "count: $count<br>";
    echo "<br>";
}
echo "Done<br>"

/* 
count: 1
count: 2
count: 3
count: 4
Done */

?>

<?php
//FOR LOOP CONTINUE

for($count=1; $count<=10; $count++){
    if ( ($count % 2 ) == 0) continue;
    echo "count: $count<br>";
    
}
echo "Done<br>"

/* 
count: 1
count: 3
count: 5
count: 7
count: 9
Done */

?>

<?php
 $x = 12;
 $y = 12 + $x++;
 echo "y = $y x = $x";
?>





