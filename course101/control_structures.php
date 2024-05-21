<?php
$ans = 42;
if ( $ans == 42 ) {
    print "Hello World </br>";
} else {
    print "Wrong answer </br>";
}
?>



<!-- IF IF ELSE -->

<?php
$x = 7;

if ( $x < 2 ) {
    print "Small </br>";
} else if ( $x < 10 ) {
    print "Medium </br>";
} else {
    print "LARGE </br>";
}

print "All done </br>"
?>

<!-- WHILE LOOP -->
<?php 
$fuel = 10;
while ($fuel > 0 ) {
    print "Vroom vroom </br>";
    $fuel =  $fuel - 1;
}
?>
<!-- A while loop is a "zero-trip"
loop with the test at the top -
before the first iteration starts.
We hand contruct the iteration variable
to implement a counted loop -->



<!-- DO WHILE LOOP -->
<?php 
$count = 1;
do {
    echo "$count times 5 is " . $count * 5;
    echo "</br>";
} while (++$count <= 5 ); 
?>
<!-- A do-while loop is a "one-trip"
loop with the test at the bottom
after the first iteration completes -->



<!-- FOR LOOP -->
<?php 
for ( $count = 1; $count <= 6; $count++) {
    echo "$count times 6 is " . $count * 6;
    echo "</br>";
}
?>
<!-- A for loop is the simplest way -
to construct a counted loop -->


<!-- BREAKING OUT FOR FOR LOOP -->
<?php 
for ( $count = 1; $count <= 600; $count++) {
    if ( $count == 5 ) break;
    echo "Count: $count </br>";
}
  echo "Done</br>";
?>
<!-- The break statement ends the current loop and jumps to the
statement immediately following th loop -->


<!-- CONTINUE STATEMENT -->
<?php 
for ( $count = 1; $count <= 10; $count++) {
    if ( ( $count % 2 ) == 0 ) continue;
    echo "Count: $count </br>";
}
  echo "Done</br>";
?>
<!-- The continue statement ends the current iteration,
jumps to the top of the loop,
and starts the next iteration -->