<?php
$x = 12;
$y = 15 + $x++;
echo "x is $x and y is $y </br>"
?>

<?php
$x = 12;
$y = 15 + $x;
$x = $x + 1;
echo "x is $x and y is $y </br>"
?>

<?php
$a = 'Hello ' . 'World!';
echo $a . "</br>";
?>

<!-- Ternary -->

<?php
$www = 123;
$msg = $www > 100 ? "Large" : "Small";
echo "First: $msg </br>";
$msg = ( $www % 2 == 0 ) ? "Even" : "Odd";
echo "Second: $msg </br>";
$msg = ( $www % 2 ) ? "Odd" : "Even";
echo "Third: $msg </br>";
?>


<?php
$vv = "Hello World!";
echo "First" . strpos($vv, "Wo") . "</br>";
echo "Second" . strpos($vv, "He") . "</br>";
echo "Third" . strpos($vv, "ZZ") . "</br>";
if (strpos($vv, "He") == FALSE ) echo "Wrong A </br>";
if (strpos($vv, "ZZ") == FALSE ) echo "Right B </br>";
if (strpos($vv, "He") !== FALSE ) echo "Right C </br>";
if (strpos($vv, "ZZ") == FALSE ) echo "Right D </br>";
print_R(FALSE); print FALSE;
echo "Where were they </br>";
?>